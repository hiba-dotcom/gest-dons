<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'description' , 'image'];

    public function imam(){
        return $this->belongsTo(User::class , 'imam_id');
    }
}
