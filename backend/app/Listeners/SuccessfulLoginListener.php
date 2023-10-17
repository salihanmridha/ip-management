<?php

namespace App\Listeners;

use App\Repositories\Contracts\AuditLogRepositoryInterface;
use App\Traits\AuditLogTrait;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

class SuccessfulLoginListener
{
    use AuditLogTrait;

    /**
     * @param  Login  $event
     *
     * @return void
     */
    public function handle(Login $event): void
    {
        $user = Auth::user();

        $modelAttributes = $this->reformatModelEventChanges($user);

        $logDesc = optional($user)->email." login successfully.";

        $this->storeAuditLog(
            "LOGIN",
            "SUCCESS",
            $modelAttributes["model_name"],
            $modelAttributes["model_path"],
            $logDesc,
            optional(auth()->user())->id,
            null
        );
    }
}
