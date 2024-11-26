<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAppointment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->status = 'Pending';
            $model->balance = $model->fee;
        });
    }
    public function appointment(){
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function items(){
        return $this->hasMany(PaymentItem::class,'payment_appoitment_id');
    }
}
