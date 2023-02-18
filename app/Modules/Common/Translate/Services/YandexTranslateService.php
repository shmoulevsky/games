<?php

namespace App\Modules\Common\Translate\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class YandexTranslateService
{
    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function translate($text, $language = 'en')
    {

        if(empty($text)) return [];

        $token = $this->getToken();

        $response = $this->client->request('POST',config('translate.yandex.base_url').'/translate/v2/translate',[
            "headers" => [ 'Authorization' => 'Bearer ' . $token ],
            "json" => [
                "folderId" => config('translate.yandex.folder'),
                "texts" => $text,
                "targetLanguageCode" => $language
            ]
        ]);

        $body = json_decode($response->getBody(), true);

        return array_column($body['translations'],'text');

    }

    public function getToken()
    {
        $token = null;

        if (Cache::has('translate.yandex')) {
            $token = Cache::get('translate.yandex');
        }else{

            $response = $this->client->request('POST',config('translate.yandex.base_token_url').'/iam/v1/tokens',[
                "json" => [
                    "yandexPassportOauthToken" => "y0_AgAAAAAFQjdEAATuwQAAAADcdjcOOQV1_TqmRK6Rgkz9zmVQKxmVAE0"
                ]
            ]);

            if ($response->getBody()) {
                $body = json_decode($response->getBody(), true);
                $token = $body['iamToken'];
            }

            Cache::put('translate.yandex', $token, 36000);
        }

        return $token;
    }

}
