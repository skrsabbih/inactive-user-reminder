<?php

namespace App\Jobs;

use App\Models\ReminderLog;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendInactiveUserReminder implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $user;
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // simulates sending reminder
        ReminderLog::create([
            'user_id' => $this->user->id,
            'sent_at' => now(),
            'message' => 'Reminder sent to inactive user.',
        ]);
    }
}
