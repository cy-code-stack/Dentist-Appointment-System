<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildTeeth extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];

    public function diseases(){
        return $this->hasMany(ChildDisease::class, 'teeth_number', 'id');
    }

}
