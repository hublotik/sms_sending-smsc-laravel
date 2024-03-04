<?php

namespace App\Http\Controllers;

use App\Models\SMS;


class StatController extends Controller
{
    public function output()
    {
        $events = SMS::select('completion', 'sms_name', 'success', 'total')->get();
        return view('stat', compact(['events']));
    }

}
