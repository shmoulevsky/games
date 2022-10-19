<?php

namespace App\Http\Controllers\V1\Admin;

use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Common\User\Common\Entities\UserStatus;
use App\Modules\Common\User\Common\Repositories\UserRepository;
use App\Modules\Common\User\Common\Requests\UserStoreRequest;
use App\Modules\Common\User\Common\Requests\UserUpdateRequest;
use App\Modules\Common\User\Common\Resources\UserCollection;
use App\Modules\Common\User\Common\Resources\UserResource;
use App\Modules\Common\User\Common\Services\UserService;
use App\Modules\Common\User\Register\DTO\UserDTO;
use Illuminate\Http\Request;

class UserController
{
    private UserRepository $userRepository;
    private UserService $userService;

    public function __construct(
        UserRepository $userRepository,
        UserService $userService
    )
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, 'created_at', 'desc');
        $users = $this->userRepository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );
        return new UserCollection($users);
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return new UserResource($user);
    }

    public function store(UserStoreRequest $request)
    {
        $dto = new UserDTO(
            null,
            $request->name,
            $request->lastname,
            $request->email,
            $request->password,
            $request->phone,
            CountryService::getCurrent(),
            LanguageService::getCurrent(),
            1,
        );

        $userDTO = $this->userService->createOrUpdate($dto);

        return response()->json([
            'user' => $userDTO->getUser()
        ]);

    }

    public function create(Request $request)
    {
        return response()->json([
            'statuses' => UserStatus::getValues()
        ]);
    }

    public function update(Request $request)
    {

        $dto = new UserDTO(
            $request->id,
            $request->name,
            $request->lastname,
            $request->email,
            $request->password,
            $request->phone,
            CountryService::getCurrent(),
            LanguageService::getCurrent(),
            1,
        );

        $userDTO = $this->userService->createOrUpdate($dto);

        return response()->json([
            'user' => $userDTO->getUser()
        ]);

    }


}
