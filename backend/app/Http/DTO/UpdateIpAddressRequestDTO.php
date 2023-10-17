<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     title="Update Ip address Request DTO",
 *     description="Update Ip address Request DTO",
 *     type="object",
 *     required={"comment"}
 * )
 */
class UpdateIpAddressRequestDTO extends Data
{
    public function __construct(
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
