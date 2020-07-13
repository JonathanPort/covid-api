<?php

namespace App\Models;

use Laravel\Nova\Actions\ActionEvent as Original;
use App\Models\Concerns\UsesUuid;

class ActionEvent extends Original
{

    use UsesUuid;

}
