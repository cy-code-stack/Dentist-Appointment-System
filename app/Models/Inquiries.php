<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiries extends Model
{
    use HasFactory;

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
