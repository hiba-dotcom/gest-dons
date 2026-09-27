<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostulationImam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'statut',
        'motivations',
        'experience',
        'motif_refus',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
