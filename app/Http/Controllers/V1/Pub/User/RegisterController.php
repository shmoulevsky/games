<?php

namespace App\Http\Controllers\V1\Pub\User;


use App\Http\Controllers\V1\Common\Controller;
use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Common\User\Register\DTO\RegisterDTO;
use App\Modules\Common\User\Register\Requests\RegisterRequest;
use App\Modules\Common\User\Register\Services\RegisterService;


class RegisterController extends Controller
{
    private $registerService;

    public function __construct(
        RegisterService           $registerService,
    )
    {
        $this->registerService = $registerService;
    }

    public function register(RegisterRequest $request)
    {
        $registerDTO = new RegisterDTO(
            null,
            $request->name,
            $request->lastname,
            $request->email,
            $request->password,
            $request->phone,
            CountryService::getCurrent(),
            LanguageService::getCurrent()
        );

        $userDTO = $this->registerService->register($registerDTO);

        return [
            'user' => $userDTO->getUser(),
            'group' => $userDTO->getGroup(),
            'message' => 'Email send to ' . $userDTO->getUser()->email
        ];
    }

    public function verify(RegisterVerifyRequest $request)
    {

    }


}
