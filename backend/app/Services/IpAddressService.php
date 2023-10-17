<?php

namespace App\Services;

use App\Http\Resources\IpAddressResource;
use App\Models\IpAddress;
use App\Repositories\Contracts\IpAddressRepositoryInterface;
use App\Services\Contracts\IpAddressServiceInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class IpAddressService implements IpAddressServiceInterface
{
    use ApiResponseTrait;

    private IpAddressRepositoryInterface $ipAddressRepo;

    public function __construct(IpAddressRepositoryInterface $ipAddressRepo)
    {
        $this->ipAddressRepo = $ipAddressRepo;
    }

    /**
     * @return JsonResponse
     */
    public function getIpAddresses(): JsonResponse
    {
        try {
            $ipAddresses = $this->ipAddressRepo->getAll();
            $data        = [
                "ip_addresses" => IpAddressResource::collection($ipAddresses),
            ];

            return $this->successResponse("Data successfully retrieve", $data, Response::HTTP_OK);
        } catch (QueryException $e) {
            Log::error("Query error : ".$e->getMessage());

            return $this->errorResponse("A query error occurred during ip addresses retrieve.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error("An exception occurred : ".$e->getMessage());

            return $this->errorResponse("Something went wrong. Please try again later.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     * @param  string  $ipAddress
     * @param  string  $comment
     *
     * @return JsonResponse
     */
    public function createIpAddress(string $ipAddress, string $comment): JsonResponse
    {
        $arr = [
            "ip_address" => $ipAddress,
            "comment"    => $comment,
            "user_id"    => optional(auth()->user())->id
        ];

        try {
            $ipAddress = $this->ipAddressRepo->create($arr);
            $data      = [
                "ip_address" => new IpAddressResource($ipAddress),
            ];

            return $this->successResponse("{$ipAddress->ip_address} ip successfully created.", $data, Response::HTTP_CREATED);

        } catch (QueryException $e) {
            Log::error("Query error : ".$e->getMessage());

            return $this->errorResponse("A query error occurred during ip addresses creation.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error("An exception occurred : ".$e->getMessage());

            return $this->errorResponse("Something went wrong. Please try again later.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @param  IpAddress  $ipAddress
     *
     * @return JsonResponse
     */
    public function showIpAddress(IpAddress $ipAddress): JsonResponse
    {
        try {
            $data      = [
                "ip_address" => new IpAddressResource($ipAddress),
            ];

            return $this->successResponse("{$ipAddress->ip_address} ip found.", $data, Response::HTTP_OK);

        } catch (QueryException $e) {
            Log::error("Query error : ".$e->getMessage());

            return $this->errorResponse("A query error occurred during ip address find.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error("An exception occurred : ".$e->getMessage());

            return $this->errorResponse("Something went wrong. Please try again later.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @param  int  $ipAddressId
     * @param  string  $comment
     *
     * @return JsonResponse
     */
    public function updateIpAddress(int $ipAddressId, string $comment): JsonResponse
    {
        $attributes = ["comment" => $comment];

        try {
            $this->ipAddressRepo->update($attributes, $ipAddressId);

            $ipAddress = $this->ipAddressRepo->find($ipAddressId);

            $data      = [
                "ip_address" => new IpAddressResource($ipAddress),
            ];

            return $this->successResponse("{$ipAddress->ip_address} ip successfully updated.", $data, Response::HTTP_OK);

        } catch (QueryException $e) {
            Log::error("Query error : ".$e->getMessage());

            return $this->errorResponse("A query error occurred during ip address update.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error("An exception occurred : ".$e->getMessage());

            return $this->errorResponse("Something went wrong. Please try again later.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
