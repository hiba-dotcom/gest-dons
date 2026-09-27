<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $fillable = [
        'name',
        'video',
        'description',
        'status' => 'pending',
        'categorie',
    ];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class ,'imam');
    }    
}
