<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuditLog extends Model
{
    use HasFactory;

    protected $guarded = ["id"];


    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        // Define the creating event
        static::creating(function ($model) {
            $model->log_uuid = Str::uuid();
        });
    }
}
