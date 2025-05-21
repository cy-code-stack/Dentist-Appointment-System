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
        return $this->belongsTo(Appointment::class, 'user_id', 'patient_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(){
        return $this->hasMany(PaymentItem::class,'payment_appoitment_id');
    }

    public function services(){
        return $this->belongsTo(Services::class, 'service_id');
    }
}
