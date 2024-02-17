<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use Khodja\Smsc\Smsc; //smsc extension
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    public $sms_text;
    public function __construct($sms_text = '') {
        $this->sms_text = $sms_text;
    }
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $users = User::all();
            foreach ($users as $user) {
                $currentYear = date('Y');
                $birth_date_with_curr_year = date('Y-m-d', strtotime("$currentYear-" . date('m-d', strtotime($user->birth_date))));
                $daysLeft = now()->diffInDays($birth_date_with_curr_year);
                if ($daysLeft == 7) {
                    // Perform the action to schedule the event if 7 days left to date
                    SmsC::send($user->phone_number, $this->sms_text);
                }
            }
        })->dailyAt('10:30');
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
