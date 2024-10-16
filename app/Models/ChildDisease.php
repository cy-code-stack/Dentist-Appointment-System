<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildDisease extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $guarded = [];

    public function childTeeth(){
        return $this->belongsTo(ChildDisease::class, 'teeth_number', 'id');
    }
}
