<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'role',
        'birthDate',
        'email',
        'password',
    ];

    public function articles(){
        return $this->hasMany(Article::class , 'imam_id');
    }

    public function dons()
    {
         return $this->hasMany(\App\Models\Don::class, 'user_id');
    }

    public function zakats()
    {
        return $this->hasMany(\App\Models\Zakat::class, 'user_id');
    }
    public function cours()
    {
        return $this->hasMany(\App\Models\Cours::class, 'imam');
    }
    public function mosquee()
    {
        return $this->hasOne(\App\Models\Mosquee::class, 'user_id');
    }
    public function postulations()
    {
        return $this->hasMany(\App\Models\Postulation::class, 'user_id');
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
