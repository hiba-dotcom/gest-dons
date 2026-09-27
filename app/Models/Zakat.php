<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'reference',
        'payment_method',
        'status',
        'purpose',
        'metadata',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
