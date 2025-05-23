<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'name',
        'description',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
