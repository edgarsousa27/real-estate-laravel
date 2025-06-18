<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvents extends Model
{
    protected $table = 'calendar_events';

    protected $fillable = [
        'title',
        'all_day',
        'more_days',
        'important',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'description',
        'color'
    ];
}
