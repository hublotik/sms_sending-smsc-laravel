<?php

namespace App\Console;

use App\ScheduleTrait;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\ScheduleEvents;
use App\Models\User;
use Khodja\Smsc\Smsc; //Smsc extension
use App\Models\SMS;
use DateTime;


class Kernel extends ConsoleKernel
{
    use ScheduleTrait;
    /**
     * Define the application's command schedule.
     */

    //send sms to users
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $sch_events = ScheduleEvents::all();
        $users = User::all();
        foreach ($sch_events as $event) {
            try {
                $schedule->call(function () use ($event, $users) {
                    $userIds = [];
                    foreach ($users as $user) {
                        $currentYear = date('Y');
                        $givenYear = date('Y', strtotime($user->birth_date));
                        $birth_date_with_curr_year = str_replace($givenYear, $currentYear, $user->birth_date);
                        $daysLeft = now()->diffInDays($birth_date_with_curr_year);
                        if ($daysLeft == $event->time_offset) {
                            //send sms right on time ;)
                            SmsC::send($user->phone_number, $event->sms_text, 0, 0, $event->id);
                            $userIds[] = $user->id;
                        }
                    }
                    $serializedUserIds = serialize($userIds);
                    $sms_stat = SMS::firstOrCreate([
                        'id' => $event->id,
                        'sms_name' => $event->event_name,
                        'serialized_users_ids' => $serializedUserIds,
                        'completion' => 0,
                    ]);
                })->dailyAt(substr($event->send_time, 0, 5));
            } catch (\Exception $e) {
                Log::error('An error occurred: ' . $e->getMessage());
            }
        }
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
