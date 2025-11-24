<?php

namespace App\Traits;

use App\Models\AuditTrail;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            self::logActivity('CREATE', $model);
        });

        static::updated(function ($model) {
            self::logActivity('UPDATE', $model);
        });

        static::deleted(function ($model) {
            self::logActivity('DELETE', $model);
        });
    }

    protected static function logActivity($action, $model)
    {
        if (!auth()->check()) {
            return;
        }

        $changes = [];
        if ($action === 'UPDATE') {
            $changes = [
                'old' => $model->getOriginal(),
                'new' => $model->getAttributes(),
            ];
        } elseif ($action === 'CREATE') {
            $changes = ['data' => $model->getAttributes()];
        } elseif ($action === 'DELETE') {
            $changes = ['deleted' => $model->getAttributes()];
        }

        AuditTrail::create([
            'user_id' => auth()->id(),
            'aksi' => $action,
            'entitas' => class_basename($model),
            'entitas_id' => $model->getKey(),
            'detail_perubahan' => json_encode($changes),
        ]);
    }
}
