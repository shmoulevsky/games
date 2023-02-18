<?php

namespace App\Http\Controllers\V1\Pub\User;


use App\Http\Controllers\V1\Common\Controller;
use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Common\User\Register\DTO\RegisterDTO;
use App\Modules\Common\User\Register\Requests\RegisterRequest;
use App\Modules\Common\User\Register\Services\RegisterService;
use App\Modules\Mail\DTO\MailDTO;
use App\Modules\Utils\Mail\Services\MailService;
use App\Modules\Utils\Notification\Services\EventManager;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    private $registerService;
    private MailService $mailService;

    public function __construct(
        RegisterService $registerService,
        MailService $mailService
    )
    {
        $this->registerService = $registerService;
        $this->mailService = $mailService;
    }

    public function register(RegisterRequest $request)
    {

        $registerDTO = new RegisterDTO(
            null,
            $request->name,
            $request->lastname ?? '',
            $request->email,
            $request->password,
            $request->phone,
            CountryService::getCurrent(),
            LanguageService::getCurrent()
        );

        $userDTO = $this->registerService->register($registerDTO);

        $data = [
            'name' => $userDTO->getUser()->name,
            'link' => $request->getHttpHost().'/confirm/'.$userDTO->getUser()->hash,
        ];

        $manager = app()->make(EventManager::class);
        $manager->handle('RegisterConfirm', $userDTO->getUser()->id, $data);



        return [
            'message' => 'Email send to ' . $userDTO->getUser()->email
        ];
    }

    public function verify(Request $request)
    {
        $user = $this->registerService->verify($request->hash);
        $token = auth()->login($user);
        
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function finish(Request $request)
    {

    }


}
