<?php

namespace App\Modules\Pub\OAuth\Services;

use App\Modules\Pub\OAuth\DTO\OAuthResult;
use App\Modules\Pub\OAuth\Enums\OAuthType;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

class OAuthVKService
{

    private string $clientId;
    private string $clientSecret;
    private string $redirectUri;
    private string $baseAuthUrl;
    private string $baseApiUrl;
    private string $token;
    private Client $client;
    private string $apiVersion;


    public function __construct()
    {
        $this->clientId = config('oauth.vk.client_id');
        $this->clientSecret = config('oauth.vk.client_secret');
        $this->redirectUri = config('oauth.vk.redirect');
        $this->baseAuthUrl = config('oauth.vk.base_auth_url');
        $this->baseApiUrl = config('oauth.vk.base_api_url');
        $this->apiVersion = config('oauth.vk.api_version');

        $this->client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function getLink() : array
    {

        $params = [
            'client_id' => $this->clientId,
            'redirect_uri'  => $this->redirectUri,
            'scopes'  => 12,
            'response_type' => 'token'
        ];

        $link =  $this->baseAuthUrl.'/authorize?'.http_build_query($params);

        return [
            'link' => $link,
            'name' => OAuthType::VK,
        ];
    }

    public function getUser() : ?OAuthResult
    {
        $params = [
            'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,country,city',
            'access_token' => $this->token,
            'v' => $this->apiVersion
        ];

        $info = $this->call('users.get', $params);

        if(!empty($info['error'])){
            return null;
        }

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

    private function call(string $url,array $params)
    {

        $response = $this->client->request(
            'GET',
            $this->baseApiUrl.'/method/'.$url.'?'.http_build_query($params),
        );

        return json_decode((string)$response->getBody(), true);
    }

}
