<?php

namespace App\Modules\Pub\OAuth\Services;

use App\Modules\Pub\OAuth\DTO\OAuthResult;
use App\Modules\Pub\OAuth\Enums\OAuthType;
use Google_Client;
use Google_Service_Oauth2;
use Illuminate\Support\Carbon;

class OAuthGoogleService
{

    private Google_Client $client;
    private ?string $token;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(config('oauth.google.client_id'));
        $this->client->setClientSecret(config('oauth.google.client_secret'));
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function getLink(string $domain) : array
    {
        $uri = 'http://'.$domain.'/'.config('oauth.google.redirect');
        $this->client->setRedirectUri($uri);

        return [
            'link' => $this->client->createAuthUrl(),
            'src' => '/assets/img/icons/google-icon.png',
            'name' => OAuthType::GOOGLE,
        ];
    }

    public function getUser() : ?OAuthResult
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($this->token);
        dd($token);
        $this->client->setAccessToken($token['access_token']);
        $oAuth = new Google_Service_Oauth2($this->client);
        $info = $oAuth->userinfo->get();

        return new OAuthResult(
            $info['response'][0]['first_name'],
            $info['response'][0]['last_name'],
            null,
            null,
            $info['response'][0]['photo_big'],
            Carbon::createFromFormat('d.m.Y', $info['response'][0]['bdate'])->format('Y-m-d'),
            $info['response'][0]['sex'],
            $info['response'][0]['country']['title'],
            $info['response'][0]['city']['title'],
            OAuthType::VK,
            $info['response'][0]['id'],
        );

    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
