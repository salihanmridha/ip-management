<?php

namespace App\Services\Contracts;

use Illuminate\Http\JsonResponse;

interface AuthenticationServiceInterface
{

    /**
     * @param  string  $email
     * @param  string  $password
     *
     * @return JsonResponse
     */
    public function login(string $email, string $password): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse;
}
