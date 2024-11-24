<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Appointment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "appointment";

    protected $fillable = [
        'id',
        'patient_id',
        'services_id',
        'sched_date',
        'sched_time',
        'appnt_status',
        'abort_reason',
    ];

    public function appointServices(){
        return $this->belongsTo(Services::class, 'services_id');
    }

    public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function payment(){
        return $this->belongsTo(PaymentAppointment::class, 'id','appointment_id');
    }
}
