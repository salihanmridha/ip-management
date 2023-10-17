<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Http forbidden Response DTO",
 *     description="Http forbidden (403 code) Response DTO",
 *     type="object",
 * )
 */
class HttpForbiddenResponseDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(
         *      title="status",
         *      example=403
         * )
         *
         * @var int
         */
        public readonly int $status,
        /**
         * @OA\Property(
         *      title="success",
         *      example=false
         * )
         *
         * @var bool
         */
        public readonly bool $success,
        /**
         * @OA\Property(
         *      title="error",
         *      type="string",
         *      example="You dont have permission to take this action"
         * )
         *
         * @var string
         */
        public readonly string $error,
    )
    {
    }
}
