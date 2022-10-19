<?php

namespace App\Modules\Common\User\Common\Services;

use App\Models\User;
use App\Modules\Common\Base\DTO\DTOInterface;
use App\Modules\Common\Base\Services\BaseService;
use App\Modules\Common\Base\Services\BaseServiceInterface;
use App\Modules\Common\User\Common\Repositories\UserRepository;


class UserService extends BaseService implements BaseServiceInterface
{

    protected $modelClass = User::class;
    protected $repositoryClass = UserRepository::class;

    private HashService $hashService;

    public function __construct(HashService $hashService)
    {
        parent::__construct();
        $this->hashService = $hashService;
    }

    public function createOrUpdate(DTOInterface $dto)
    {
        $user = $this->getItem($dto->id);
        $user->name = $dto->name;
        $user->lastname = $dto->lastname;
        $user->email = $dto->email;
        $user->email_verified_at = $dto->emailVerifiedAt;
        $user->phone = $dto->phone;
        $user->phone_verified_at = $dto->phoneVerifiedAt;
        $user->access_panel = $dto->accessPanel;
        $user->ref_id = $dto->refId;

        if($dto->password){
            $user->password = $this->hashService->generatePasswordHash($dto->password);
        }

        $user->hash = $this->hashService->generateHash();
        $user->country_id = $dto->countryId;
        $user->language = $dto->language;
        $user->save();

        return $user;
    }
}
