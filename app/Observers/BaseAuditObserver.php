<?php

namespace App\Observers;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseAuditObserver
{
    public function created(Model $model): void
    {
        $this->record($model, 'created', [], $model->getAttributes());
    }

    public function updated(Model $model): void
    {
        $dirty = $model->getDirty();
        $original = [];

        foreach ($dirty as $key => $value) {
            $original[$key] = $model->getOriginal($key);
        }

        $this->record($model, 'updated', $original, $dirty);
    }

    public function deleted(Model $model): void
    {
        $this->record($model, 'deleted', $model->getOriginal(), []);
    }

    private function record(Model $model, String $action, array $old, array $new): void
    {
        Log::create([
            'entity_type'   => get_class($model),
            'entity_id'     => $model->getKey(),
            'action'        => $action,
            'old_values'    => $old ?: null,
            'new_values'    => $new ?: null,
            'user_id'       => Auth::id(),
            'user_name'     => Auth::user()->getFullNameAttribute() ?? 'system',
        ]);
    }
}
