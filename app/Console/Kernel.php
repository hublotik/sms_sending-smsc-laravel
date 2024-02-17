<?php

namespace App\Console;

use Illuminate\Support\Facades\Log;
use Exception;
use App\ScheduleTrait;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\ScheduleEvents;

class Kernel extends ConsoleKernel
{
    use ScheduleTrait;
    /**
     * Define the application's command schedule.
     */

     //send sms to users
     protected function schedule(Schedule $schedule): void
     {
        self::schedule_sms_send($schedule);
        self::event_status_update($schedule);
     }


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
