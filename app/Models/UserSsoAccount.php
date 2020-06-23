<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Concerns\UsesUuid;

class UserSsoAccount extends Model
{

    use UsesUuid;

    protected $fillable = [
        'provider_id',
        'provider_name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
