<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\DTO\LoginRequestDTO;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\Contracts\AuthenticationServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    private AuthenticationServiceInterface $authService;

    public function __construct(AuthenticationServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="loginUser",
     *      tags={"Authentication"},
     *      summary="Login an user",
     *      description="Login an user and Returns json response",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequestDTO")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResponseDTO")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(
                        property="status",
     *                  type="int",
     *                  example=401,
     *              ),
     *              @OA\Property(
                        property="success",
     *                  type="bool",
     *                  example=false,
     *              ),
     *              @OA\Property(
                        property="error",
     *                  type="string",
     *                  example="Email and Password doesn't match",
     *              ),
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(ref="#/components/schemas/UnprocessableContentResponseDTO")
     *      ),
     * )
     */
    public function login(LoginRequest $request, LoginRequestDTO $requestDTO): JsonResponse
    {
        return $this->authService->login($requestDTO->email, $requestDTO->password);
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        request()->user()->currentAccessToken()->delete();
    }
}
