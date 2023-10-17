<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Http not found Response DTO",
 *     description="Http not found (404 code) Response DTO",
 *     type="object",
 * )
 */
class HttpNotFoundResponseDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(
         *      title="status",
         *      example=404
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
         *      example="Something not found"
         * )
         *
         * @var string
         */
        public readonly string $error,
    )
    {
    }
}
