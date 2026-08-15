<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'marca',
        'modelo',
        'anio',
        'color',
        'precio',
        'kilometraje',
        'imagen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
