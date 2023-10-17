<?php

namespace App\Listeners;

use App\Repositories\Contracts\AuditLogRepositoryInterface;
use App\Traits\AuditLogTrait;
use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class FailedLoginListener
{
    use AuditLogTrait;


    /**
     * @param  Failed  $event
     *
     * @return void
     */
    public function handle(Failed $event): void
    {
        $user = $event->user;

        $modelAttributes = $this->reformatModelEventChanges($user);

        $logDesc = optional($user)->email." login attempt failed!";

        $this->storeAuditLog(
            "LOGIN",
            "FAILED",
            $modelAttributes["model_name"],
            $modelAttributes["model_path"],
            $logDesc,
            optional($user)->id,
            null
        );

    }
}
