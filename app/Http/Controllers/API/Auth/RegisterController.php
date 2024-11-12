<?php
declare(strict_types=1);
namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use App\Traits\SendResponse;
use Illuminate\Http\JsonResponse;


class RegisterController extends Controller
{
    use SendResponse;
    public function __invoke(RegistrationRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());
        SendWelcomeEmail::dispatchSync($user);
        return $this->success($user, 'Your account has been created.');
    }
}
