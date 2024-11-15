<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\SendResponse;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    use SendResponse;

    public function __invoke(LoginRequest $request): JsonResponse
    {
        if (!auth()->attempt($request->validated())) {
            return $this->failed([], trans('auth.failed'));
        }
        $token = auth()->user()
            ->createToken('authToken')
            ->plainTextToken;

        return $this->success($this->respondWithToken($token), 'You have successfully logged in.');
    }

    protected function respondWithToken(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('sanctum.expiration') ? config('sanctum.expiration') * 60 : null,
        ];
    }
}
