<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuditLogRequest;
use App\Http\Requests\UpdateAuditLogRequest;
use App\Models\AuditLog;
use App\Services\Contracts\AuditLogServiceInterface;
use Illuminate\Http\JsonResponse;

class AuditLogController extends Controller
{
    private AuditLogServiceInterface $auditLog;
    public function __construct(AuditLogServiceInterface $auditLog)
    {
        $this->auditLog = $auditLog;
    }
    /**
     * @OA\Get(
     *      path="/audit-log",
     *      operationId="getAuditLogList",
     *      tags={"AuditLog"},
     *      summary="Get list of audit logs",
     *      description="Returns list of audit logs",
     *      security={{"sanctum":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AuditLogResponseDTO")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     )
     */
    public function index(): JsonResponse
    {
        return $this->auditLog->getAuditLogs();
    }
}
