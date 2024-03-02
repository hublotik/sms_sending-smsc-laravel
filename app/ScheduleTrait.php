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
       
    }
}
