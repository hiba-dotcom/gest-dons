<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mosquee extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'image', 'chef_id', 'adresse_id'];

    public function chef() {
        return $this->belongsTo(User::class, 'chef_id');
    }
    
    public function adresse() {
        return $this->belongsTo(MosqueeAdresse::class, 'adresse_id');
    }
}
