<?php

namespace App\Listeners;

use App\Events\TaskUpdated;
use App\Models\TaskHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogTaskUpdates
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskUpdated $event)
    {
        foreach ($event->changes as $field => $values) {
            TaskHistory::create([
                'task_id' => $event->task->id,
                'field' => $field,
                'old_value' => $values['old'],
                'new_value' => $values['new'],
            ]);
        }
    }
}
