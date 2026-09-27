<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'association_id', // allow mass assignment
    ];
    
    protected $attributes = [
        'status' => 'pending'
    ];
    
    protected $casts = [
        'amount' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function association()
    {
        return $this->belongsTo(\App\Models\Association::class);
    }
}
