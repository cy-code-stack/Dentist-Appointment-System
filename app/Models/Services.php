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

    protected $fillable = [
        'id',
        'services_name',
        'services_requirements',
        'services_duration',
        'services_price',
        'serv_status',
    ];

}
