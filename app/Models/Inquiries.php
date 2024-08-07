<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Inquiries extends Model
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'inquiry';

    public $timestamps = false;

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'fblink',
        'cnumber',
        'message',
        'reply',
        'status',
    ];

}
