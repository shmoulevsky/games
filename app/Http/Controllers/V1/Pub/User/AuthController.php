<?php

namespace App\Http\Controllers\V1\Pub\User;


use App\Http\Controllers\V1\Common\Controller;
use App\Modules\Common\User\Auth\DTO\AuthDTO;
use App\Modules\Common\User\Auth\Requests\AuthRequest;
use App\Modules\Common\User\Auth\Services\AuthService;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;


class AuthController extends Controller
{
    private $authService;


    public function __construct(
        AuthService               $authService,
    )
    {
        $this->authService = $authService;
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {

        $userDTO = $this->authService->refresh();

        return response()->json([
            'access_token' => $userDTO->getToken(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);

    }

    public function login(AuthRequest $request)
    {
        $authDTO = new AuthDTO($request->email, $request->password);

        try {
            $userDTO = $this->authService->login($authDTO);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['login' => $exception->getMessage()]);
        }

        return [
            'access_token' => $userDTO->getToken(),
            'user' => $userDTO->getUser(),
            'group' => $userDTO->getGroup(),
        ];

    }

}
