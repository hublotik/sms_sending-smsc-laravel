<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleEvents extends Model
{
    /* define table name  */

    protected $table = 'schedule_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'send_time',
        'sms_text',
        'time_offset',
        'event_name',
        'id',
    ];
}
