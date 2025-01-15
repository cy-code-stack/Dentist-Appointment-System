<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Services extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "services";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'services_name',
        'price',
        'serv_status',
    ];

}
