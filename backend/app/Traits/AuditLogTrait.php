<?php

namespace App\Traits;

use App\Repositories\Contracts\AuditLogRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

trait AuditLogTrait
{
    private AuditLogRepositoryInterface $auditLogRepo;

    public function __construct(AuditLogRepositoryInterface $auditLogRepo)
    {
        $this->auditLogRepo = $auditLogRepo;
    }

    public function storeAuditLog(
        string $event,
        string $status,
        ?string $modelName = null,
        ?string $modelPath = null,
        ?string $log_description = null,
        ?int $logCreator = null,
        ?string $properties = null,
    ): void {
        $this->auditLogRepo->create([
            "event"           => $event,
            "status"          => $status,
            "model_name"      => $modelName,
            "model_path"      => $modelPath,
            "log_description" => $log_description,
            "log_creator"     => $logCreator,
            "properties"      => $properties,
        ]);
    }

    /**
     * @param  Model  $model
     *
     * @return array<mixed>
     */
    public function reformatModelEventChanges(Model $model): array
    {

        $modelName = class_basename($model);
        $modelPath = get_class($model);

        if (count($model->getChanges()) > 0) {
            $properties = $this->updateEventProperties($model);
        } else {
            $properties = $this->createEventProperties($model);
        }


        return [
            "model_name" => $modelName,
            "model_path" => $modelPath,
            "properties" => $properties,
        ];

    }

    /**
     * @param  Model  $model
     *
     * @return false|string
     */
    private function createEventProperties(Model $model)
    {
        $properties = [];
        $attributes = $model->getAttributes();

        $properties["attribute"] = $attributes;

        return json_encode($properties);
    }

    /**
     * @param  Model  $model
     *
     * @return false|string
     */
    private function updateEventProperties(Model $model)
    {
        $changes  = $model->getChanges();
        $original = $model->getOriginal();

        $properties = [];

        $changedKeys = array_keys($changes);
        foreach ($changedKeys as $key) {
            $properties['old'][$key]       = $original[$key] instanceof Carbon ? $original[$key]->format('Y-m-d H:i:s') : $original[$key];
            $properties['attribute'][$key] = $changes[$key] instanceof Carbon ? $changes[$key]->format('Y-m-d H:i:s') : $changes[$key];
        }

        return json_encode($properties);
    }
}
