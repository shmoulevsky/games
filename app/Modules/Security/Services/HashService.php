<?php

namespace App\Modules\Security\Services;

use Ramsey\Uuid\Uuid;

class HashService
{
    public function generatePasswordHash($password) : string
    {
        return bcrypt($password);
    }

    public function generateHash() : string
    {
        return Uuid::uuid4();
    }

    public function generateRandomPasswordHash() : string
    {
        return bcrypt(Uuid::uuid4());
    }

    public function generateOld(string $password)
    {
        return md5($password.env('JWT_SECRET'));
    }

    function getOAuthCode($verifier)
    {
        $code = pack('H*', hash('sha256', $verifier));
        $code = base64_encode($code);
        $code = trim($code, "=");
        return strtr($code, '+/', '-_');
    }

}
