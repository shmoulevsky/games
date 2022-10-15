<?php

namespace App\Modules\Security\Repositories;

use App\Modules\Base\BaseRepository;
use App\Modules\Security\DTO\PasswordResetDTO;
use App\Modules\Security\Models\PasswordReset;
use Illuminate\Support\Facades\DB;

class PasswordResetRepository extends BaseRepository
{
    protected $modelClass = PasswordReset::class;

    public function getCount(PasswordResetDTO $dto)
    {
        return $this->model
            ->where('email', $dto->to)
            ->count();
    }

    public function getSmsCount(PasswordResetDTO $dto)
    {
        return DB::table('sms_codes')
            ->where('phone', $dto->to)
            ->count();
    }

    public function getCode(string $code)
    {
        return DB::table('password_resets')
            ->where('code', $code)
            ->first();
    }

    public function getSmsCode(string $phone, string $code)
    {
        return DB::table('sms_codes')
            ->where([
                ['code', $code],
                ['phone', $phone]
            ])
            ->first();
    }
}
