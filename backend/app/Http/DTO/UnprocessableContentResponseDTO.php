<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Unprocessable Content Response DTO",
 *     description="Unprocessable Content (422 code) Response DTO",
 *     type="object",
 * )
 */
class UnprocessableContentResponseDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(
         *      title="status",
         *      example=422
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
         *      title="message",
         *      type="string",
         *      example="Requested data validation failed."
         * )
         *
         * @var string
         */
        public readonly string $message,

        /**
         * @OA\Property(
         *     title = "errors",
         *     type="object",
         *     @OA\Property(
                    property="key",
         *          type="array",
         *          @OA\Items(
                        type="string",
         *              example="Validation error shows for the key"
         *          ),
         *     ),
         * )
         */
        public readonly array $errors,
    )
    {
    }
}
