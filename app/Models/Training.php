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
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
