<?php

namespace App\Repositories;

use App\Models\AuditLog;
use App\Repositories\Contracts\AuditLogRepositoryInterface;

class AuditLogRepository extends BaseRepository implements AuditLogRepositoryInterface
{
    /**
     * Audit Log repository constructor.
     *
     * @param AuditLog $auditLog
     */
    public function __construct(AuditLog $auditLog)
    {
        parent::__construct($auditLog);

        $this->model = $auditLog;
    }
}
