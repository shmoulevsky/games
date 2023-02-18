<?php

namespace App\Http\Controllers\V1\Pub\User;


use App\Http\Controllers\V1\Common\Controller;
use App\Modules\Pub\OAuth\Factories\OAuthServiceFactory;
use App\Modules\Pub\OAuth\Services\OAuthLoginService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OAuthController extends Controller
{
    public function __construct(

    )
    {

    }

    public function getLink(Request $request)
    {
        $factory = new OAuthServiceFactory();
        $oAuthService = $factory->make($request->type);
        $links[] = $oAuthService->getLink();

        return response()->json(['links' => $links]);
    }

    public function login(Request $request)
    {

        $factory = new OAuthServiceFactory();
        $loginService = new OAuthLoginService();

        $oAuthService = $factory->make($request->type);
        $oAuthService->setToken($request->access_token);
        $oAuthResult = $oAuthService->getUser();

        if(empty($oAuthResult)){
            throw ValidationException::withMessages(['Error service. Try again later']);
        }

        $user = $loginService->handle($oAuthResult);
        $token = auth()->login($user);

        return [
            'access_token' => $token,
            'user' => $user,
            'group' => $user->group_id,
        ];

    }

}
