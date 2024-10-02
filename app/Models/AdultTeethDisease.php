<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdultTeethDisease extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function teeth(){
        return $this->belongsTo(AdultTeeth::class, 'teeth_number', 'id');
    }
}
