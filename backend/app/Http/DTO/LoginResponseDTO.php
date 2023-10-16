<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Login Response DTO",
 *     description="Login response DTO",
 *     type="object",
 * )
 */
class LoginResponseDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(
         *     title="status",
         *     example=200
         * )
         *
         * @var int
         */
        public readonly int $status,
        /**
         * @OA\Property(
         *     title="success",
         *     example=true
         * )
         *
         * @var bool
         */
        public readonly bool $success,
        /**
         * @OA\Property(
         *     title="message",
         *     example="Login successfully!"
         * )
         *
         * @var string
         */
        public readonly string $message,
        /**
         * @OA\Property(
         *     title="data",
         *     type="object",
         *     properties={
         *         @OA\Property(
         *             property="access_token",
         *             type="string",
         *             example="your-access-token"
         *         ),
         *         @OA\Property(
         *             property="user",
         *             type="object",
         *             properties={
         *                 @OA\Property(
         *                     property="name",
         *                     type="string",
         *                     example="Salihan Mridha"
         *                 ),
         *                 @OA\Property(
         *                     property="email",
         *                     type="string",
         *                     example="salihanmridha@gmail.com"
         *                 ),
         *             }
         *         ),
         *     }
         * )
         *
         * @var array<mixed>
         */
        public readonly array $data,
    )
    {
    }
}
