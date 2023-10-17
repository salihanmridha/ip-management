<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\DTO\StoreIpAddressRequestDTO;
use App\Http\DTO\UpdateIpAddressRequestDTO;
use App\Http\Requests\StoreIpAddressRequest;
use App\Http\Requests\UpdateIpAddressRequest;
use App\Models\IpAddress;
use App\Services\Contracts\IpAddressServiceInterface;
use Illuminate\Http\JsonResponse;

class IpAddressController extends Controller
{
    private IpAddressServiceInterface $ipAddress;

    public function __construct(IpAddressServiceInterface $ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }


    /**
     * @OA\Get(
     *      path="/ip-address",
     *      operationId="getIpAddressList",
     *      tags={"IpAddress"},
     *      summary="Get list of ip addresses",
     *      description="Returns list of ip addresses",
     *      security={{"sanctum":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/IpAddressResponseDTO")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     )
     */
    public function index(): JsonResponse
    {
        return $this->ipAddress->getIpAddresses();
    }

    /**
     * @OA\Post(
     *      path="/ip-address",
     *      operationId="store_ip_address",
     *      tags={"IpAddress"},
     *      summary="Store new ip address",
     *      description="Store ip address data",
     *      security={{"sanctum":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreIpAddressRequestDTO")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/StoreIpAddressResponseDTO")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(ref="#/components/schemas/UnprocessableContentResponseDTO")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated",
     *              ),
     *          )
     *       ),
     *     ),
     * )
     */
    public function store(StoreIpAddressRequest $request, StoreIpAddressRequestDTO $requestDTO): JsonResponse
    {
        return $this->ipAddress->createIpAddress($requestDTO->ip_address, $requestDTO->comment);
    }

    /**
     * @OA\Get(
     *      path="/ip-address/{id}",
     *      operationId="getIpById",
     *      tags={"IpAddress"},
     *      summary="Get ip information",
     *      description="Returns ip data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Ip address id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/IpAddressShowResponseDTO")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="404 not found",
     *          @OA\JsonContent(ref="#/components/schemas/HttpNotFoundResponseDTO")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated",
     *              ),
     *          )
     *       ),
     *     ),
     * )
     */
    public function show(IpAddress $ipAddress): JsonResponse
    {
        return $this->ipAddress->showIpAddress($ipAddress);
    }

    /**
     * @OA\Put(
     *      path="/ip-address/{id}",
     *      operationId="updateIp",
     *      tags={"IpAddress"},
     *      summary="Update existing ip",
     *      description="Returns updated ip data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="IP id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateIpAddressRequestDTO")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/IpAddressShowResponseDTO")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="404 not found",
     *          @OA\JsonContent(ref="#/components/schemas/HttpNotFoundResponseDTO")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(ref="#/components/schemas/UnprocessableContentResponseDTO")
     *      ),
     * )
     */
    public function update(UpdateIpAddressRequest $request, IpAddress $ipAddress, UpdateIpAddressRequestDTO $requestDTO): JsonResponse
    {
        return $this->ipAddress->updateIpAddress($ipAddress->id, $requestDTO->comment);
    }
}
