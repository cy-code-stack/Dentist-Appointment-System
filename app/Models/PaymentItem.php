<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false; 

    // protected static function booted(): void
    // {
    //     static::creating(function ($model) {
    //         $model->status = 'Pending';
    //         $model->balance = $model->fee;
    //     });
    // }

    public function record(){
        return $this->belongsTo(PaymentAppointment::class,'payment_appoitment_id');
    }
}
