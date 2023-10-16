<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Services\Contracts\AuthenticationServiceInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationService implements AuthenticationServiceInterface
{
    use ApiResponseTrait;

    /**
     * @param  string  $email
     * @param  string  $password
     *
     * @return JsonResponse
     */
    public function login(string $email, string $password): JsonResponse
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user                 = Auth::user();
            $token                = $user->createToken('authentication')->plainTextToken;
            $data["access_token"] = $token;
            $data["user"]         = new UserResource($user);

            return $this->successResponse("Login successfully!", $data, Response::HTTP_OK);
        }

        return $this->errorResponse("Email and Password doesn't match", Response::HTTP_UNAUTHORIZED);
    }
}
