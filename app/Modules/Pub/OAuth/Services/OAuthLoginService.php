<?php

namespace App\Modules\Pub\OAuth\Services;

use App\Models\User;
use App\Modules\Common\User\Common\Entities\UserGroup;
use App\Modules\Pub\OAuth\DTO\OAuthResult;
use App\Modules\Pub\OAuth\Jobs\StoreUserPhotoJob;
use Ramsey\Uuid\Uuid;

class OAuthLoginService
{

    public function handle(OAuthResult $oAuthResult)
    {
        $user = User::where([
            'oauth_type' => $oAuthResult->type,
            'oauth_id' => $oAuthResult->id,
        ])->first();

        if(!empty($user)){
            return $user;
        }

        $user = new User();
        $user->name = $oAuthResult->name;
        $user->lastname = $oAuthResult->lastName;
        $user->email = $oAuthResult->email;
        $user->phone = $oAuthResult->phone;
        $user->password = bcrypt(UUID::uuid4());

        $user->birthday = $oAuthResult->birthday;
        $user->sex = $oAuthResult->sex;
        $user->country = $oAuthResult->country;
        $user->city = $oAuthResult->city;
        $user->group_id = UserGroup::USER;
        $user->oauth_type = $oAuthResult->type;
        $user->oauth_id = $oAuthResult->id;
        $user->save();

        dispatch(new StoreUserPhotoJob($oAuthResult->photo, $user));

        return $user;
    }
}
