<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdultTeeth extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $guarded = ['id'];

    public function diseases(){
        return $this->hasMany(AdultTeethDisease::class, 'teeth_number', 'id');
    }
}
