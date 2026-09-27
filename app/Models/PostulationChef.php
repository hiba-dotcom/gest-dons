<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostulationChef extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id', 'mosquee_id', 'statut', 'motivations', 'experiences'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }

    public function mosquee()
    {
        return $this->belongsTo(Mosquee::class);
    }
}
