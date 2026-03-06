<?php

namespace App\Console\Commands;

use App\Jobs\SendInactiveUserReminder;
use App\Models\User;
use Illuminate\Console\Command;


class CheckInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:check-inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find inactive users and dispatch reminder jobs.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // inactive days for pdf requirement (configurable inactivity days)
        $inactiveDays  = config('inactive_users.days', 7);

        // inactive users query for date calculation
        $inactiveDate = now()->subDays($inactiveDays);

        // fetch users who are inactive and haven't received a reminder today
        $inactiveUsers = User::query()
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '<=', $inactiveDate)
            ->whereDoesntHave('reminderLogs', function ($query) {
                $query->whereDate('sent_at', today());
            })->get();

        // Dispatches a queued job for each user
        foreach ($inactiveUsers as $user) {
            SendInactiveUserReminder::dispatch($user);
        }

        // Command output
        $this->info('Inactive user reminder jobs dispatched successfully. ' . $inactiveUsers->count() . ' users.');
    }
}
