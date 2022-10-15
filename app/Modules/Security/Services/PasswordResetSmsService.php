<?php

namespace App\Modules\Security\Services;

use App\Modules\Mail\Services\MailService;
use App\Modules\Security\DTO\PasswordResetDTO;
use App\Modules\Security\DTO\PasswordResetVerifyDTO;
use App\Modules\Security\Models\PasswordReset;
use App\Modules\Security\Repositories\PasswordResetRepository;

use App\Modules\Sms\Models\SmsCode;
use App\Modules\Sms\Services\SmsService;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class PasswordResetSmsService extends PasswordResetService
{
    const MAX_TRIES_COUNT = 5;
    protected $repositoryClass = PasswordResetRepository::class;
    protected $modelClass = SmsCode::class;
    private $smsService;
    /**
     * @var HashService
     */
    private $hashService;

    public function __construct(
        UserRepository $userRepository,
        SmsService $smsService,
        HashService $hashService
    )
    {
        parent::__construct($userRepository, $hashService);
        $this->smsService = $smsService;
    }

    protected function generateCode()
    {
        return rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    }

    protected function store(PasswordResetDTO $dto, string $code)
    {
        $this->model->phone = $dto->to;
        $this->model->code = $code;
        $this->model->group = 'password';
        $this->model->save();
    }

    public function verify(PasswordResetVerifyDTO $dto)
    {
        try{
            $code = $this->repository->getSmsCode($dto->to, $dto->code);

            if (empty($code)) {
                throw new \Exception('code not found');
            }

            DB::transaction(function () use ($dto, $code){
                $user = $this->userRepository->getByPhone($code->phone);

                if (empty($user)) {
                    throw new \Exception('user with phone not found');
                }

                $user->password = Hash::make($dto->password);
                DB::table('sms_codes')
                    ->where('phone', $code->phone)
                    ->delete();
            });

            return ['status' => true, 'error' => null];

        }catch (\Exception $exception){
            return ['status' => false, 'error' => $exception->getMessage()];//.' '.$exception->getFile().' '.$exception->getLine()];
        }

    }

    protected function checkUserGuard(PasswordResetDTO $dto)
    {
        $user = $this->userRepository->getByPhone($dto->to);

        if (empty($user)) {
            throw new \Exception('user with phone not found');
        }
    }

    protected function send(PasswordResetDTO $dto, $code)
    {
        $this->smsService->send($dto->to, $code);
    }

    protected function checkCountGuard(PasswordResetDTO $dto)
    {
        $count = $this->repository->getSmsCount($dto);
        if ($count >= static::MAX_TRIES_COUNT) {
            throw new \Exception('Max attempts. Try again later');
        }
    }

}
