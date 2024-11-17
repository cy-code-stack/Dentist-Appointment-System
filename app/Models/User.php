<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";

    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'middle_initial',
        'home_address',
        'phone_number',
        'status',
        'email',
        'password',
        'role',
        'is_verified',
        'profile_img',
        'marital_status',
        'occupation',
        'age',
        'sex'
    ];

    public function appointment(){
        return $this->hasMany(Appointment::class, 'patient_id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

}
