<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MosqueeAdresse extends Model
{
    use HasFactory;

    protected $fillable = ['boulevard', 'ville', 'pays'];

    public function mosquee() {
        return $this->hasOne(Mosquee::class, 'adresse_id');
    }
}
