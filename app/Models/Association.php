<?php

namespace App\Models;   

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'image',
        'slogan',
        'description',
        'totaleMembres',
        'totaleBudget',
        'status' => 'pending'
    ];

    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }

    public function postulation()
    {
        return $this->belongsTo(Postulation::class);
    }

    
}
