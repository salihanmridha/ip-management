<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Audit Log Response DTO",
 *     description="Audit log response DTO",
 *     type="object",
 * )
 */
class AuditLogResponseDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(
         *      title="status",
         *      example=200
         * )
         *
         * @var int
         */
        public readonly int $status,
        /**
         * @OA\Property(
         *      title="success",
         *      example=true
         * )
         *
         * @var bool
         */
        public readonly bool $success,
        /**
         * @OA\Property(
         *      title="message",
         *      example="Data successfully retrieve"
         * )
         *
         * @var string
         */
        public readonly string $message,
        /**
         * @OA\Property(
         *      title="data",
         *      type="array",
         *      @OA\Items(
         *          type="object",
         *          properties={
         *              @OA\Property(
         *                  property="log_uuid",
         *                  type="string",
         *                  example="28baea4c-7c14-42a2-a752-2278fb90c5ed"
         *              ),
         *              @OA\Property(
         *                  property="model_name",
         *                  type="string|null",
         *                  example="IpAddress"
         *              ),
         *              @OA\Property(
         *                  property="model_path",
         *                  type="string|null",
         *                  example="App\Models\User"
         *              ),
         *              @OA\Property(
         *                  property="event",
         *                  type="string",
         *                  example="LOGIN"
         *              ),
         *              @OA\Property(
         *                  property="status",
         *                  type="string",
         *                  example="SUCCESS"
         *              ),
         *              @OA\Property(
         *                  property="log_description",
         *                  type="string|null",
         *                  example="salihanmridha@gmail.com login successfully."
         *              ),
         *              @OA\Property(
         *                  property="log_creator",
         *                  type="int|null",
         *                  example=1
         *              ),
         *              @OA\Property(
         *                  property="properties",
         *                  type="string|null",
         *                  example="{old: {data}, attribute: {data}}",
         *              ),
         *              @OA\Property(
         *                  property="created_at",
         *                  type="string",
         *                  example="2023-10-14T03:57:39.000000Z"
         *              ),
         *              @OA\Property(
         *                  property="updated_at",
         *                  type="string",
         *                  example="2023-10-14T03:57:39.000000Z"
         *              ),
         *              @OA\Property(
         *                  property="user",
         *                  type="object",
         *                  properties={
         *                      @OA\Property(
         *                          property="name",
         *                          type="string",
         *                          example="Salihan Mridha"
         *                      ),
         *                      @OA\Property(
         *                          property="email",
         *                          type="string",
         *                          example="salihanmridha@gmail.com"
         *                      ),
         *                  }
         *              ),
         *          }
         *      )
         * )
         *
         * @var array<mixed>
         */
        public readonly array $data,
    ) {
    }
}
