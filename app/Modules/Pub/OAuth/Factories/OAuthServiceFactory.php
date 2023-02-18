<?php

namespace App\Modules\Pub\OAuth\Factories;

use App\Modules\Pub\OAuth\Enums\OAuthType;

use App\Modules\Pub\OAuth\Services\OAuthGoogleService;
use App\Modules\Pub\OAuth\Services\OAuthVKService;

class OAuthServiceFactory
{

    public function make(string $type)
    {
        switch ($type){
            case OAuthType::VK : return new OAuthVKService();
            case OAuthType::GOOGLE : return new OAuthGoogleService();
        }
    }
}
