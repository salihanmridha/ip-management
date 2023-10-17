<?php

namespace App\Observers;

use App\Models\IpAddress;
use App\Traits\AuditLogTrait;

class IpAddressObserver
{
    use AuditLogTrait;

    /**
     * Handle the IpAddress "created" event.
     */
    public function created(IpAddress $ipAddress): void
    {
        $modelAttributes = $this->reformatModelEventChanges($ipAddress);

        $logDesc = optional(auth()->user())->email." created IP address {$ipAddress->ip_address} with '{$ipAddress->comment}' comment";

        $this->storeAuditLog(
            "CREATE",
            "SUCCESS",
            $modelAttributes["model_name"],
            $modelAttributes["model_path"],
            $logDesc,
            optional(auth()->user())->id,
            $modelAttributes["properties"]
        );
    }

    /**
     * Handle the IpAddress "updated" event.
     */
    public function updated(IpAddress $ipAddress): void
    {
        $modelAttributes = $this->reformatModelEventChanges($ipAddress);

        $logDesc = optional(auth()->user())->email." updated IP address {$ipAddress->ip_address} with '{$ipAddress->comment}' comment";

        $this->storeAuditLog(
            "UPDATE",
            "SUCCESS",
            $modelAttributes["model_name"],
            $modelAttributes["model_path"],
            $logDesc,
            optional(auth()->user())->id,
            $modelAttributes["properties"]
        );
    }

    /**
     * Handle the IpAddress "deleted" event.
     */
    public function deleted(IpAddress $ipAddress): void
    {
        //
    }

    /**
     * Handle the IpAddress "restored" event.
     */
    public function restored(IpAddress $ipAddress): void
    {
        //
    }

    /**
     * Handle the IpAddress "force deleted" event.
     */
    public function forceDeleted(IpAddress $ipAddress): void
    {
        //
    }
}
