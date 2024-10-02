<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInformationRecord extends Model
{
    use HasFactory;
    protected $table = 'patient_information_records';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');    
    }

    public function diagnostic(){
        return $this->belongsTo(PatientDiagnostic::class, 'diagnostic_id');
    }
    public function diagnostics()
    {
        return $this->hasMany(PatientDiagnostic::class, 'patient_information_id'); 
    }
}
