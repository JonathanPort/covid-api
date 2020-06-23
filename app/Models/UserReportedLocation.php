<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UsesUuid;

class UserReportedLocation extends Model
{

    use UsesUuid;

    protected $fillable = [
        'user_id', 'city', 'county', 'country',
    ];

}
