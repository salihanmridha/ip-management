<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $log_uuid
 * @property ?string $model_name
 * @property ?int $model_path
 * @property string $event
 * @property string $status
 * @property ?string $log_description
 * @property ?string $log_creator
 * @property ?string $properties
 * @property string $created_at
 * @property string $updated_at
 * @property ?UserResource $user
 */

class AuditLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'log_uuid' => $this->log_uuid,
            'model_name' => $this->model_name,
            'model_path' => $this->model_path,
            'event' => $this->event,
            'status' => $this->status,
            'log_description' => $this->log_description,
            'log_creator' => $this->log_creator,
            'properties' => $this->properties,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->user),
        ];
    }
}
