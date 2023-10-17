<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Store IpAddress Response DTO",
 *     description="Store IpAddress response DTO",
 *     type="object",
 * )
 */
class StoreIpAddressResponseDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(
         *      title="status",
         *      example=201
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
         *      example="127.0.0.1 ip successfully created."
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
         *                  property="ip_address",
         *                  type="string",
         *                  example="202.92.249.111,"
         *              ),
         *              @OA\Property(
         *                  property="comment",
         *                  type="string",
         *                  example="gifts.ad-group.com.au"
         *              ),
         *              @OA\Property(
         *                  property="user_id",
         *                  type="int",
         *                  example=1
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
