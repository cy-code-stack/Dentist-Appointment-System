<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class CalendarEvent extends Model
{
    use HasFactory;
    protected  $table = 'calendar_event';
    public $timestamps = false;

    protected $fillable = [ 
        'id',
        'event_name',
        'start_date',
        'end_date',
    ];
}
