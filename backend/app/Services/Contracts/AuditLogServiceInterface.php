<?php

namespace App\Services\Contracts;

use App\Models\IpAddress;
use Illuminate\Http\JsonResponse;

interface AuditLogServiceInterface
{

    /**
     *
     * @return JsonResponse
     */
    public function getAuditLogs(): JsonResponse;
}
