<?php
namespace App;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\ScheduleEvents;
use App\Models\User;
use Khodja\Smsc\Smsc; //Smsc extension
use App\Models\SMS;
use DateTime;


// Replace the year in the given data with the current year
trait ScheduleTrait
{
    protected static function schedule_sms_send(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $sch_events = ScheduleEvents::all();
        $users = User::all();

        foreach ($sch_events as $event) {
            $schedule->call(function () use ($event, $users) {
                $userIds = [];
                foreach ($users as $user) {
                    try {
                        $currentYear = date('Y');
                        $givenYear = date('Y', strtotime($user->birth_date));
                        $birth_date_with_curr_year = str_replace($givenYear, $currentYear, $user->birth_date);
                        $daysLeft = now()->diffInDays($birth_date_with_curr_year);

                        if ($daysLeft == $event->time_offset) {
                            //send sms right on time ;)
                            SmsC::send($user->phone_number, $event->sms_text, 0, 0, $event->id);
                            $userIds[] = $user->id;
                        }
                        $serializedUserIds = serialize($userIds);

                        $sms_stat = SMS::firstOrCreate([
                            'id' => $event->id,
                            'sms_name' => $event->event_name,
                            'serialized_users_ids' => $serializedUserIds,
                            'completion' => 0,
                        ]); 
                    } catch (\Exception $e) {

                        Log::error('An error occurred: ' . $e->getMessage());
                    }
                }

            })->dailyAt(substr($event->send_time, 0, 5));
        }
        
    }
   

    protected static function event_status_update(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $sended_sms_events = SMS::all();
        foreach ($sended_sms_events as $event) {
            $users_in_event = unserialize($event->serialized_users_ids);
            $schedule->call(function () use ($event, $users_in_event) {
                $pos_res = 0;
                foreach ($users_in_event as $user_id) {
                    $phone_numbers = User::where('id', $user_id)->select('phone_number')->get();
                    //iterate through numbers for checking status of each number
                    
                    foreach ($phone_numbers as $phone_number) {
                        try {
                            $curr_num_stat = Smsc::getStatus($event->id, $phone_number);

                            // (status, time, err, ...) или (0, -error)
                            if (count($curr_num_stat) > 2) {
                                //check that we actually do not have an error
                                $pos_res++;
                            }
                        } catch (Exception $e) {
                            Log::error('An error occurred: ' . $e->getMessage());
                        }
                    }
                }
                $completion = ($pos_res / count($phone_numbers)) * 100;

                SMS::where('id', $event->id)->update([
                    'completion' => $completion,
                ]);
            })->everyTenMinutes(); // for example every 10 mins
        }
    }
}
