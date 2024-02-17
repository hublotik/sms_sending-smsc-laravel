<?php

namespace App\Http\Controllers;

use App\Models\SMS;


class StatController extends Controller
{
    public function output()
    {
        $events = SMS::select('completion', 'sms_name')->get();
        return view('stat', compact(['events']));
    }

}
