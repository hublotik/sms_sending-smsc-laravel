<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    /* define table name  */

    protected $table = 'sended_sms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'sms_name',
        'serialized_users_ids',
        'completion',
        'success',
        'total'
    ];
}
