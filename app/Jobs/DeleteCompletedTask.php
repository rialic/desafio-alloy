<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DeleteCompletedTask implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $task = new Task();
        $task->onlyTrashed()->forceDelete();
    }
}
