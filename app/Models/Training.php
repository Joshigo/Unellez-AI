<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'learn',
        'name',
        'file_path',
        'keywords',
        'type',
    ];

    protected $casts = [
        'keywords' => 'array', // Guardamos como array en columna JSON aunque venga como string desde el formulario
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
