<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Services\Contracts\AuthenticationServiceInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        try {
            $login = Auth::attempt(['email' => $email, 'password' => $password]);
            if ($login && Auth::user()) {
                $user  = Auth::user();
                $token = $user->createToken('authentication_token')->plainTextToken;
                $data  = [
                    "access_token" => $token,
                    "user"         => new UserResource($user)
                ];

                return $this->successResponse("Login successfully!", $data, Response::HTTP_OK);
            }

            return $this->errorResponse("Email and Password doesn't match", Response::HTTP_UNAUTHORIZED);
        } catch (AuthenticationException $e) {
            Log::error("Authentication error: ".$e->getMessage());

            return $this->errorResponse("An error occurred during authentication.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (QueryException $e) {
            Log::error("Query error : ".$e->getMessage());

            return $this->errorResponse("A query error occurred during authentication.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error("An exception occurred : ".$e->getMessage());

            return $this->errorResponse("Something went wrong. Please try again later.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $user = request()->user();
            if ($user && $user->currentAccessToken() !== null) {
                $user->currentAccessToken()->delete();

                return $this->successResponse('Logout successfully!', null, Response::HTTP_OK);
            }

            return $this->errorResponse("User is not authenticated to perform this action",
                Response::HTTP_FORBIDDEN);
        } catch (\Exception $e) {
            Log::error("Logout error: ".$e->getMessage());

            return $this->errorResponse("Something went wrong during logout. Please try again",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
