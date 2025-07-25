<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'content',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function response()
    {
        return $this->hasOne(Response::class);
    }
}
