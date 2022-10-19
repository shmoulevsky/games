<?php

namespace App\Modules\Common\User\Register\Services;


use App\Models\User;
use Carbon\Carbon;

class RegisterVerifyService
{
    public function verify(string $code)
    {
        $user = User::where('hash', $code)->first();

        if($user->email_verified_at !== null){
            throw new \Exception('User has been already verified');
        }

        $user->email_verified_at = Carbon::now();
        $user->save();
        return $user;
    }

    private function getConfirmLink(User $user) : string
    {
        return request()->getHttpHost().'/auth/verify/'.$user->hash;
    }

}
