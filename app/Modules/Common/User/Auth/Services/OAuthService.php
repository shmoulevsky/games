<?php

namespace App\Modules\Common\User\Auth\Services;


use App\Modules\Common\User\Auth\DTO\AuthResultDTO;
use App\Modules\Common\User\Common\Entities\UserStatus;
use App\Modules\Common\User\Common\Services\HashService;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;


class OAuthService
{

    private $userRepository;
    private $baseUrl;
    private $clientId;
    private $secret;
    /**
     * @var Client
     */
    private $client;
    private AuthService $authService;
    private HashService $hashService;

    public function __construct(
        UserRepository $userRepository,
        Client $client,
        AuthService $authService,
        HashService $hashService
    )
    {
        $this->userRepository = $userRepository;
        $this->baseUrl =  config('external-login.url');
        $this->clientId = config('external-login.client_id');
        $this->secret = config('external-login.secret');
        $this->client = $client;
        $this->authService = $authService;
        $this->hashService = $hashService;
    }

    public function getLink()
    {
        $verifier = '3OrQlzueTjrqaLYLCdz_RcZKb7IY_ZQzZWPdtx7TcHM';
        $params = [
            'code_challenge' => $this->hashService->getOAuthCode($verifier),
            'code_challenge_method' => 'S256',
            'resourceServer' => 'IdentityServer',
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'redirect_uri=' => request()->getHttpHost().'/oauth/token'
        ];

        return $this->baseUrl."?".http_build_query($params);
    }

    public function getToken($code)
    {

        $response = $this->client->request('POST', '/nidp/oauth/nam/token',
            [
                'query' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->secret,
                    'code' => $code,
                ],
                'verify' => false
            ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getUser($accessToken)
    {
        $response = $this->client->request(
            'GET',
            '/nidp/oauth/nam/userinfo',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$accessToken
                ],
                'verify' => false
            ]
        );

        return json_decode($response->getBody()->getContents(), true);

    }

    public function authOrRegister($userInfo, $country, $language)
    {
        $user = DB::table('users')::where('code', $userInfo['zehut']);

        if(empty($user)){
            $user = new User();
            $user->name = $userInfo['given_name'];
            $user->lastname = $userInfo['family_name'];
            $user->email = $userInfo['email'];
            $user->email_verified_at = Carbon::now();
            $user->phone = $userInfo['phone'];
            $user->code = $userInfo['zehut'];
            $user->status = UserStatus::ACTIVE;
            $user->country_id = $country;
            $user->language = $language;
            $user->save();
        }

        $token = JWTAuth::fromUser($user);

        //$token = new Token($tokenString);
        //JWTAuth::setToken($token);

        $user = auth()->user();
        $group = $this->authService->getUserGroup($user);

        return new AuthResultDTO($user, $token, $group);
    }

}
