<?php

namespace App\Modules\Common\User\Register\Services;


use App\Models\User;
use App\Modules\Common\User\Auth\DTO\AuthResultDTO;
use App\Modules\Common\User\Common\Entities\UserStatus;
use App\Modules\Common\User\Common\Repositories\UserRepository;
use App\Modules\Common\User\Common\Services\HashService;
use App\Modules\Common\User\Register\DTO\RegisterDTO;
use Illuminate\Support\Carbon;


class RegisterService
{

    public function __construct(
        HashService $hashService,
        UserRepository $userRepository,
    )
    {
        $this->hashService = $hashService;
        $this->userRepository = $userRepository;
    }

    public function register(RegisterDTO $dto) :AuthResultDTO
    {

        $refUserId = null;

        if(!empty($dto->affiliate)){
            $refUserId = $dto->affiliate;
        }

        $user = new User();
        $user->name = $dto->name;
        $user->lastname = $dto->lastname;
        $user->email = $dto->email;
        $user->phone = $dto->phone ?? null;

        $user->password = $this->hashService->generatePasswordHash($dto->password);
        $user->hash = $this->hashService->generateHash();
        $user->status = UserStatus::NOT_CONFIRMED;
        $user->country_id = $dto->countryId;
        $user->language = $dto->language;
        $user->ref_id = $refUserId;
        $user->save();

        return new AuthResultDTO($user, '', []);
    }

    public function registerOrUpdateByAdmin(RegisterDTO $dto) :AuthResultDTO
    {

        $user = User::find($dto->id);

        if(empty($user)){
            $user = new User();
        }

        $user->name = $dto->name;
        $user->lastname = $dto->lastname;
        $user->email = $dto->email;
        $user->email_verified_at = Carbon::now();
        $user->phone = $dto->phone;
        $user->password = $this->hashService->generatePasswordHash($dto->password);
        $user->hash = $this->hashService->generateHash();
        $user->city_id = isset($city) ? $city->id : null;
        $user->country_id = $dto->countryId;
        $user->language = $dto->language;
        $user->save();

        return new AuthResultDTO($user, '', []);
    }

    public function verify(?string $hash)
    {
        $user = User::where('hash', $hash)->first();
        $user->email_verified_at = Carbon::now();
        $user->save();

        return $user;
    }

}
