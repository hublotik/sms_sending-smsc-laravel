<?php

namespace App\Http\Controllers;

use App\Models\ScheduleEvents;
use Illuminate\Http\Request;
use Khodja\Smsc\Smsc;

class ScheduleSmsController extends Controller
{
    public function schedule()
    {
        return view('schedule');
    }

    public function schedule_create(Request $request)
    {
        $event = ScheduleEvents::firstOrCreate(
            [
                'event_name' => $request->input('event_name'),
                'sms_text' => $request->input('sms_text'),
                'send_time' =>  $request->input('send_time'),
                'time_offset' =>  $request->input('time_offset'),
            ]
        );

        return redirect()->route('welcome')->with('success', 'Рассылка создана успешно');
    }
}
