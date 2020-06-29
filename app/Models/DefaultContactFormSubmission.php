<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UsesUuid;

class DefaultContactFormSubmission extends Model
{

    use UsesUuid;

    protected $fillable = [
        'full_name', 'email', 'subject', 'message',
    ];

}
