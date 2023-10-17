<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Store Ip address Request DTO",
 *     description="Store Ip address Request DTO",
 *     type="object",
 *     required={"ip_address", "comment"}
 * )
 */
class StoreIpAddressRequestDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(
         *      title="ip_address",
         *      description="Valid IP address",
         *      example="121.28.229.28"
         * )
         *
         * @var string
         */
        public readonly string $ip_address,
        /**
         * @OA\Property(
         *      title="comment",
         *      description="Comment of IP address",
         *      example="Comment for ip 121.28.229.28"
         * )
         *
         * @var string
         */
        public readonly string $comment,
    ) {
    }
}
