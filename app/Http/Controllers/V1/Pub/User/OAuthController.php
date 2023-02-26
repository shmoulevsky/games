<?php

namespace App\Http\Controllers\V1\Pub\User;


use App\Http\Controllers\V1\Common\Controller;
use App\Modules\Common\Country\Repositories\CountryRepository;
use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Pub\OAuth\Factories\OAuthServiceFactory;
use App\Modules\Pub\OAuth\Services\OAuthLoginService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OAuthController extends Controller
{
    private CountryRepository $countryRepository;

    public function __construct(
        CountryRepository $countryRepository
    )
    {
        $this->countryRepository = $countryRepository;
    }

    public function getLink(Request $request)
    {
        $factory = new OAuthServiceFactory();
        $country = CountryService::getCurrent();
        $types = $this->countryRepository->getOAuth($country);

        $links = [];

        foreach ($types as $type){
            $oAuthService = $factory->make($type);
            $links[] = $oAuthService->getLink($request->getHttpHost());
        }

        return response()->json(['links' => $links]);
    }

    public function login(Request $request)
    {

        $factory = new OAuthServiceFactory();
        $loginService = new OAuthLoginService();

        $oAuthService = $factory->make($request->type);
        $oAuthService->setToken($request->access_token ?? $request->code);
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
