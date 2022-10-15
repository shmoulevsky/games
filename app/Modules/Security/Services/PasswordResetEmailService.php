<?php

namespace App\Modules\Security\Services;

use App\Modules\Mail\Services\MailService;
use App\Modules\Security\DTO\PasswordResetDTO;
use App\Modules\Security\DTO\PasswordResetVerifyDTO;
use App\Modules\Security\Models\OldPassword;
use App\Modules\Security\Models\PasswordReset;
use App\Modules\Security\Repositories\PasswordResetRepository;

use App\Modules\User\Entities\UserStatus;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class PasswordResetEmailService extends PasswordResetService
{
    const MAX_TRIES_COUNT = 5;
    protected $repositoryClass = PasswordResetRepository::class;
    protected $modelClass = PasswordReset::class;
    private $mailService;
    private HashService $hashService;

    public function __construct(
        UserRepository $userRepository,
        MailService $mailService,
        HashService $hashService
    )
    {
        parent::__construct($userRepository, $hashService);
        $this->mailService = $mailService;
        $this->hashService = $hashService;
    }

    protected function generateCode()
    {
        return Uuid::uuid4();
    }

    protected function store(PasswordResetDTO $dto, string $code)
    {
        $this->model->email = $dto->to;
        $this->model->code = $code;
        $this->model->save();
    }

    public function verify(PasswordResetVerifyDTO $dto)
    {

            $code = $this->repository->getCode($dto->code);

            if (empty($code)) {
                Log::channel('auth')->error("verify: code {$dto->code} not found");
                throw ValidationException::withMessages(["verify: code {$dto->code} not found"]);
            }

            DB::transaction(function () use ($dto, $code){
                $user = $this->userRepository->getByEmail($code->email);

                if (empty($user)) {
                    Log::channel('auth')->error("verify: user email {$code->email} not found");
                    throw ValidationException::withMessages(["verify: user email {$code->email} not found"]);
                }

                $oldPasswords = OldPassword::where('user_id', $user->id)
                    ->get()
                    ->pluck('password')
                    ->toArray();

                if (in_array($this->hashService->generateOld($dto->password), $oldPasswords)) {
                    Log::channel('auth')->error("This password was use last time. Please use another one");
                    throw ValidationException::withMessages(["This password was use last time. Please use another one"]);
                }

                $user->password = bcrypt($dto->password);

                OldPassword::create([
                    "password" => $this->hashService->generateOld($dto->password),
                    "user_id" => $user->id,
                ]);

                $this->checkPasswordExpired($user);

                $user->save();

                DB::table('password_resets')
                    ->where('email', $code->email)
                    ->delete();
            });

        return ['status' => true];


    }

    protected function checkUserGuard(PasswordResetDTO $dto)
    {
        $user = $this->userRepository->getByEmail($dto->to);

        if (empty($user)) {
            Log::channel('auth')->error("send: user email {$dto->to} not found");
            throw new \Exception("user email {$dto->to} not found");
        }
    }

    protected function send(PasswordResetDTO $dto, $code)
    {
        $this->mailService->send($dto->to, $dto->language, MailService::TYPES['restore'], ['link' => $this->getResetLink($code)]);
    }

    public function getResetLink($code)
    {
        return request()->getHttpHost().'/auth/verify/'.$code;
    }

    private function checkPasswordExpired($user)
    {
        if($user->status === UserStatus::OLD_PASSWORD){
            $user->status = UserStatus::ACTIVE;
        }
    }

}
