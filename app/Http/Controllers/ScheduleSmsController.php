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
        $services = include(config_path('services.php'));
        $smsc_login = $request->input('smsc_login');
        $smsc_password = $request->input('smsc_password');
        if(!empty($smsc_login) and !empty($smsc_password)){ //write your credentials in services.php file
            $services['smsc']['login'] = $smsc_login;
            $services['smsc']['password'] = $smsc_password;
            $content = '<?php return ' . var_export($services, true) . ';';
            file_put_contents(config_path('services.php'), $content);
        }

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
