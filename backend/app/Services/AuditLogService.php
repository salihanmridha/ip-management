<?php

namespace App\Services;

use App\Http\Resources\AuditLogResource;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use App\Services\Contracts\AuditLogServiceInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuditLogService implements AuditLogServiceInterface
{
    use ApiResponseTrait;

    private AuditLogRepositoryInterface $auditLogRepo;

    public function __construct(AuditLogRepositoryInterface $auditLogRepo)
    {
        $this->auditLogRepo = $auditLogRepo;
    }

    /**
     * @return JsonResponse
     */
    public function getAuditLogs(): JsonResponse
    {
        try {
            $auditLogs = $this->auditLogRepo->getAll();
            $data        = [
                "audit_logs" => AuditLogResource::collection($auditLogs),
            ];

            return $this->successResponse("Data successfully retrieve", $data, Response::HTTP_OK);
        } catch (QueryException $e) {
            Log::error("Query error : ".$e->getMessage());

            return $this->errorResponse("A query error occurred during audit log retrieve.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error("An exception occurred : ".$e->getMessage());

            return $this->errorResponse("Something went wrong. Please try again later.",
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
