<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildDiagnostic extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];

    public function information(){
        return $this->belongsTo(PatientInformationRecord::class,'information_id');
    }
    public function teeth(){
        return $this->belongsTo(ChildTeeth::class,'teeth_id');
    }
    public function disease(){
        return $this->belongsTo(ChildDisease::class,'disease_id');
    }
}
