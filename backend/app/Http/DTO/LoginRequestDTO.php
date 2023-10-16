<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Login Request DTO",
 *     description="Login Request DTO",
 *     type="object",
 *     required={"email", "password"}
 * )
 */
class LoginRequestDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(
         *      title="email",
         *      description="Email of the user",
         *      example="salihanmridha@gmail.com"
         * )
         *
         * @var string
         */
        public readonly string $email,
        /**
         * @OA\Property(
         *      title="password",
         *      description="Password of the user",
         *      example="12345678"
         * )
         *
         * @var string
         */
        public readonly string $password,
    ) {
    }
}
