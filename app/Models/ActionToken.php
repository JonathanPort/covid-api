<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UsesUuid;

class ActionToken extends Model
{

    use UsesUuid;

    protected $fillable = [
        'user_id', 'action', 'token', 'payload',
    ];


    protected static function booted()
    {
        static::creating(function ($token) {
            $token->token = Str::random(15);
        });
    }

}
