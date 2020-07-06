<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UsesUuid;

class UserContact extends Model
{

    use UsesUuid;

    protected $fillable = [
        'user_id', 'friend_id',
    ];


    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');

    }


    public function friend()
    {

        return $this->belongsTo(User::class, 'friend_id');

    }


}
