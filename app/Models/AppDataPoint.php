<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class AppDataPoint extends Model
{

    use UsesUuid;

    protected $fillable = [
        'name', 'uri', 'content',
    ];

}
