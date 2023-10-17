<?php

namespace App\Services\Contracts;

use App\Models\IpAddress;
use Illuminate\Http\JsonResponse;

interface IpAddressServiceInterface
{

    /**
     *
     * @return JsonResponse
     */
    public function getIpAddresses(): JsonResponse;

    /**
     * @param  string  $ipAddress
     * @param  string  $comment
     *
     * @return JsonResponse
     */
    public function createIpAddress(string $ipAddress, string $comment): JsonResponse;

    /**
     * @param  IpAddress  $ipAddress
     *
     * @return JsonResponse
     */
    public function showIpAddress(IpAddress $ipAddress): JsonResponse;

    /**
     * @param  int  $ipAddressId
     * @param  string  $comment
     *
     * @return JsonResponse
     */
    public function updateIpAddress(int $ipAddressId, string $comment): JsonResponse;
}
