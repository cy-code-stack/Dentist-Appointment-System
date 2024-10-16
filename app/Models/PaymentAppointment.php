<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAppointment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function appointment(){
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
