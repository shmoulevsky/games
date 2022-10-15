<?php

namespace App\Modules\Security\Services;

use App\Models\User;
use App\Modules\City\Services\CityService;
use App\Modules\Mail\Interfaces\MailSenderInterface;
use App\Modules\Mail\Services\MailService;
use App\Modules\School\Services\SchoolService;
use App\Modules\Security\DTO\RegisterDTO;
use App\Modules\Security\DTO\UserDTO;
use App\Modules\Security\Models\OldPassword;
use App\Modules\Security\Repositories\PasswordResetRepository;
use App\Modules\TariffPlan\Services\TariffPlanSubscriptionService;
use App\Modules\User\Entities\UserStatus;
use App\Modules\User\Modules\Agent\DTO\ActivateTeacherDTO;
use App\Modules\User\Repositories\UserRepository;
use App\Utils\Property;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use function bcrypt;

class RegisterService
{
    /**
     * @var MailSenderInterface
     */
    private $mailer;
    /**
     * @var CityService
     */
    private $cityService;
    /**
     * @var SchoolService
     */
    private $schoolService;
    /**
     * @var TariffPlanSubscriptionService
     */
    private $tariffPlanSubscriptionService;
    /**
     * @var HashService
     */
    public $hashService;
    private UserRepository $userRepository;
    private PasswordResetRepository $passwordResetRepository;

    public function __construct(
        MailSenderInterface $mailer,
        CityService $cityService,
        SchoolService $schoolService,
        TariffPlanSubscriptionService $tariffPlanSubscriptionService,
        HashService $hashService,
        UserRepository $userRepository,
    )
    {
        $this->mailer = $mailer;
        $this->cityService = $cityService;
        $this->schoolService = $schoolService;
        $this->tariffPlanSubscriptionService = $tariffPlanSubscriptionService;
        $this->hashService = $hashService;
        $this->userRepository = $userRepository;
    }

    public function register(RegisterDTO $registerDTO) :UserDTO
    {

        $schools = $this->schoolService->createOrFindSchool(
            $registerDTO->schools,
            $registerDTO->language,
            $registerDTO->countryId
        );

        $city = $this->cityService->createOrFindCity(
            $registerDTO->city,
            $registerDTO->language,
            $registerDTO->countryId
        );

        $refUserId = null;
        if(!empty($registerDTO->affiliate)){
            $refUserId = $this->getReferralId($registerDTO->affiliate);
        }
        $refUserId = Property::exist($refUserId, 'user_id');

        $user = new User();
        $user->name = $registerDTO->name;
        $user->lastname = $registerDTO->lastname;
        $user->email = $registerDTO->email;
        $user->phone = $registerDTO->phone;
        $user->code = $registerDTO->code;
        $user->password = $this->hashService->generatePasswordHash($registerDTO->password);
        $user->hash = $this->hashService->generateHash();
        $user->city_id = isset($city) ? $city->id : null;
        $user->status = UserStatus::NOT_CONFIRMED;
        $user->country_id = $registerDTO->countryId;
        $user->language = $registerDTO->language;
        $user->ref_id = $refUserId;
        $user->save();

        $this->syncSchools($user, $schools);
        $this->syncGrades($user, $registerDTO);
        $this->syncTopics($user, $registerDTO);
        $this->syncSubjects($user, $registerDTO);
        $this->syncQualifications($user, $registerDTO);

        $this->mailer->send(
            $user->email,
            $registerDTO->language,
            MailService::getType('register'),
            ['link' => $this->getConfirmLink($user)]
        );

        return new UserDTO($user, '', []);
    }

    public function registerOrUpdateByAdmin(RegisterDTO $registerDTO) :UserDTO
    {

        $schools = $this->schoolService->createOrFindSchool(
            $registerDTO->schools,
            $registerDTO->language,
            $registerDTO->countryId
        );

        $city = $this->cityService->createOrFindCity(
            $registerDTO->city,
            $registerDTO->language,
            $registerDTO->countryId
        );

        $user = User::find($registerDTO->id);
        if(empty($user)){
            $user = new User();
        }


        $user->name = $registerDTO->name;
        $user->lastname = $registerDTO->lastname;
        $user->email = $registerDTO->email;
        $user->email_verified_at = Carbon::now();
        $user->phone = $registerDTO->phone;
        $user->code = $registerDTO->code;
        $user->password = $this->hashService->generatePasswordHash($registerDTO->password);
        $user->hash = $this->hashService->generateHash();
        $user->city_id = isset($city) ? $city->id : null;

        $user->country_id = $registerDTO->countryId;
        $user->language = $registerDTO->language;
        $user->save();

        OldPassword::create([
            "password" => $this->hashService->generateOld($user->password),
            "user_id" => $user->id,
        ]);

        $this->syncSchools($user, $schools);
        $this->syncGrades($user, $registerDTO);
        $this->syncTopics($user, $registerDTO);
        $this->syncSubjects($user, $registerDTO);
        $this->syncQualifications($user, $registerDTO);
        $this->syncSubscriptions($user, $registerDTO);

        return new UserDTO($user, '', []);
    }

    public function verifyUser(string $code)
    {
        $user = User::where('hash', $code)->first();

        if($user->email_verified_at !== null){
            throw new \Exception('User has been already verified');
        }

        $user->email_verified_at = Carbon::now();
        $user->save();
        return $user;
    }

    public function activateTeacher(ActivateTeacherDTO $dto)
    {
        $user = $this->userRepository->getByHash($dto->code);

        DB::transaction(function () use ($dto, $user) {

            if (empty($user)) {
                Log::channel('auth')->error("verify teacher (agent): code {$dto->code} not found");
                throw ValidationException::withMessages(["verify: code {$dto->code} not found"]);
            }

            if ($user->status === UserStatus::ACTIVE) {
                Log::channel('auth')->error("Already activated user {$user->email}");
                throw ValidationException::withMessages(["Your user is already activated"]);
            }

            $user->password = bcrypt($dto->password);

            OldPassword::create([
                "password" => $this->hashService->generateOld($dto->password),
                "user_id" => $user->id,
            ]);

            $user->email_verified_at = Carbon::now();
            $user->hash = $this->hashService->generateHash();
            $user->status = UserStatus::ACTIVE;
            $user->save();

        });

        return $user;

    }

    public function getConfirmLink(User $user) : string
    {
        return request()->getHttpHost().'/auth/verifi/'.$user->hash;
    }

    private function syncGrades(User $user, RegisterDTO $registerDTO)
    {
        if(empty($registerDTO->grades)) return null;

        if(count($registerDTO->grades) > 0){
            $user->grades()->sync($registerDTO->grades);
        }
    }

    private function syncTopics(User $user, RegisterDTO $registerDTO)
    {
        if(empty($registerDTO->topics)) return null;

        if(count($registerDTO->topics) > 0){
            $user->topics()->sync($registerDTO->topics);
        }
    }

    private function syncQualifications(User $user, RegisterDTO $registerDTO)
    {
        if(empty($registerDTO->qualifications)) return null;

        if(count($registerDTO->qualifications) > 0){
            $user->qualifications()->sync($registerDTO->qualifications);
        }
    }

    private function syncSubjects(User $user, RegisterDTO $registerDTO)
    {
        if(empty($registerDTO->subjects)) return null;

        if(count($registerDTO->subjects) > 0){
            $user->subjects()->sync($registerDTO->subjects);
        }
    }

    private function getReferralId(?string $code)
    {
        return DB::table('referral_codes')
            ->select(['user_id'])
            ->where('code', $code)
            ->first('user_id');
    }

    private function syncSchools(User $user, $schools)
    {
        if(empty($schools)) return null;

        if(count($schools) > 0){
            $user->schools()->sync($schools);
        }
    }

    private function syncSubscriptions(User $user, RegisterDTO $registerDTO)
    {
        if(empty($registerDTO->tariffPlans)) {
            return;
        }

        $this->tariffPlanSubscriptionService->syncSubscriptions($user, $registerDTO->tariffPlans, $registerDTO->countryId);
    }

}
