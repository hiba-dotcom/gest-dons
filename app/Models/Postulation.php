<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;
    protected $fillable = [
        'experiences',
        'plan',
        'motivations'
    ];
    public function association()
    {
        return $this->hasOne(Association::class);
    }

    public function president()
    {
        return $this->belongsTo(User::class , 'president_id');
    }
}
