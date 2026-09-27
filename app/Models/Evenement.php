<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'budget',
        'dateDebut',
        'dateFin',
        'lieu_id',
        'association_id',
        'image',
        'description',
    ];
    protected $casts = [
        'dateDebut' => 'datetime',
        'dateFin' => 'datetime',
    ];

    public function adresse()
    {
        return $this->belongsTo(Adresse::class ,'lieu_id');
    }

    public function association()
    {
        return $this->belongsTo(Association::class );
    }
}
