<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ActionToken extends Model
{

    protected $fillable = [
        'user_id', 'action', 'token',
    ];


    protected static function booted()
    {
        static::creating(function ($token) {
            $token->token = Str::random(15);
        });
    }

}
