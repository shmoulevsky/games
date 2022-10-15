<?php
namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authService;
    private $registerService;
    private $passwordResetEmailService;

    public function __construct(
        AuthService $authService,
        RegisterService $registerService,
        PasswordResetEmailService $passwordResetEmailService,
    )
    {
        $this->authService = $authService;
        $this->registerService = $registerService;
        $this->passwordResetEmailService = $passwordResetEmailService;
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {

        $userDTO = $this->authService->refresh();

        return [
            'access_token' => $userDTO->getToken(),
            'user' => $userDTO->getUser(),
            'group' => $userDTO->getGroup(),
        ];

    }

    public function check(Request $request)
    {
        return response()->json([ 'valid' => auth()->check() ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    private function guard()
    {
        return Auth::guard();
    }

    public function verifyUser($code)
    {
        $user = $this->registerService->verifyUser($code);

        if (!empty($user->email_verified_at))
        {
            return response()->json(['status' => 'success'], 200);
        }
        return ['error' => true, 'code' => '402'];
    }

    public function login(AuthRequest $request)
    {
        $authDTO = new AuthDTO($request->email, $request->password);

        try{
            $userDTO = $this->authService->login($authDTO);
        }catch (\Exception $exception){
            throw ValidationException::withMessages(['login' => $exception->getMessage()]);
        }

        return [
            'access_token' => $userDTO->getToken(),
            'user' => $userDTO->getUser(),
            'group' => $userDTO->getGroup(),
        ];

    }

    public function register(RegisterRequest $request)
    {
        $registerDTO = new RegisterDTO(
            null,
            $request->name,
            $request->lastname,
            $request->email,
            $request->password,
            $request->phone,
            CountryService::getCurrent(),
            LanguageService::getCurrent(),
            []
        );

        $userDTO = $this->registerService->register($registerDTO);

        return [
            'code' => 200,
            'user' => $userDTO->getUser(),
            'group' => $userDTO->getGroup(),
            'result' => true,
            'message' => 'Email send to '.$userDTO->getUser()->email
        ];
    }

    public function sendRestorePassword(RestoreSendRequest $request)
    {
        $language = LanguageService::getCurrent();

        $dto = new PasswordResetDTO(
            $language,
            $request->to,
            $request->type,
        );

        $result = $this->passwordResetEmailService->handle($dto);

    }

    public function verifyRestorePassword(RestoreVerifyRequest $request)
    {
        $language = LanguageService::getCurrent();

        $dto = new PasswordResetVerifyDTO(
            $language,
            $request->to,
            $request->code,
            $request->password,
            $request->type
        );

        $result = $this->passwordResetEmailService->verify($dto);

        return response()->json([
            'status' => $result['status'] ?? 'wrong',
            'error' => $result['error'] ?? null,
        ]);
    }


}
