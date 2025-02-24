<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDiagnostic extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function patient(){
        return $this->belongsTo(PatientInformationRecord::class, 'patient_information_id');
    }
    public function teeth(){
        return $this->belongsTo(AdultTeeth::class, 'teeth_id');
    }
    public function teethDisease(){
        return $this->belongsTo(AdultTeethDisease::class, 'disease_id', 'id');
    }
}
