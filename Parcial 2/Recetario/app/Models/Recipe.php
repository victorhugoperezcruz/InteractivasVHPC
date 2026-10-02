<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'categoria',
        'tiempo',
        'dificultad',
        'ingredientes',
        'pasos',
        'nota_personal',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
