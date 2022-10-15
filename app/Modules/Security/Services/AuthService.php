<?php

namespace App\Modules\Security\Services;

use App\Models\User;
use App\Modules\Security\DTO\AuthDTO;
use App\Modules\Security\DTO\UserDTO;
use App\Modules\User\Entities\UserStatus;
use App\Modules\User\Repositories\UserRepository;
use App\Modules\Utils\Auth\JWTHelper;
use Illuminate\Support\Facades\Log;

class AuthService
{
    private const PANEL_ACCESS = 1;
    private const NULL_GROUP = 0;
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(AuthDTO $authDTO) : UserDTO
    {

        $credentials = $this->getCredentials($authDTO);
        $token = auth()->attempt($credentials);

        if (!$token) {
            Log::channel('auth')->error("An error occurred while logging in. Check email and password ".$authDTO->login);
            throw new \DomainException('An error occurred while logging in. Check email and password');
        }

        $user = auth()->user();
        $this->statusGuard($user);

        $group = $this->getUserGroup($user);

        return new UserDTO($user, $token, $group);
    }

    public function refresh() : UserDTO
    {
        $token = auth()->refresh();
        $user = auth()->user();
        $group = $this->getUserGroup($user);

        return new UserDTO($user, $token, $group);
    }

    public function getUserGroup(User $user) : array
    {
        $group = [];

        if($this->isHasPanelAccess($user)){
            $userGroup = $this->userRepository->getUserGroup($user->group_id);
            $group = [
                'name' => $userGroup->name,
                'page_access' => $userGroup->getPageAccess()
            ];

        }

        return $group;
    }

    private function getCredentials(AuthDTO $authDTO)
    {
        if($this->isEmail($authDTO->login)){
            return [
                'email' => $authDTO->login,
                'password' => $authDTO->password
            ];
        }

        if($this->isPhone($authDTO->login)){
            return [
              'phone' => $authDTO->login,
              'password' => $authDTO->password
            ];
        }

        return [
            'name' => $authDTO->login,
            'password' => $authDTO->password
        ];

    }

    private function isPhone($login):bool
    {
        return is_numeric((int)$login);
    }

    private function isEmail($login):bool
    {
        return filter_var($login, FILTER_VALIDATE_EMAIL);
    }

    private function isEmailVerified($user) :bool
    {
        return !empty($user->email_verified_at);
    }

    private function isHasPanelAccess($user) :bool
    {
        return $user['access_panel'] === self::PANEL_ACCESS && $user['group_id'] !== self::NULL_GROUP;
    }

    public function refreshByDomain($token)
    {
        $jwtHelper = new JWTHelper();

        $isValid = $jwtHelper->isValid($token);


        $tokenInfo = $jwtHelper->decode($token);

        if(empty($tokenInfo) || !$isValid) return null;

        $newToken = auth()->tokenById($tokenInfo->sub);
        $user = User::find($tokenInfo->sub);
        $group = $this->getUserGroup($user);

        return new UserDTO($user, $newToken, $group);

    }

    private function statusGuard($user)
    {
        if($user->status === UserStatus::BLOCKED){
            Log::channel('auth')->error("User is blocked ".$user->login);
            throw new \DomainException('User is blocked');
        }

        if($user->status === UserStatus::NOT_ACCEPTED){
            Log::channel('auth')->error("Agent is not accepted by admin ".$user->login);
            throw new \DomainException("Agent is not accepted by admin");
        }

        if ($user->status === UserStatus::OLD_PASSWORD)
        {
            throw new \DomainException("Password expired", 450);
        }

        if($user->status === UserStatus::AGENT_ACCEPTED){
            Log::channel('auth')->error("Please finish your registration ".$user->login);
            throw new \DomainException("Please finish your registration");
        }

        if(!$this->isEmailVerified($user)){
            Log::channel('auth')->error("Your have not verified your email ".$user->email);
            throw new \DomainException('Your have not verified your email');
        }
    }
}
