<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Concerns\UsesUuid;

class UserCovidReport extends Model
{

    use UsesUuid;

    protected $fillable = [
        'user_id', 'user_reported_location_id', 'status', 'date_tested', 'date_symptoms_started',
    ];


    protected $casts = [
        'date_tested' => 'datetime',
        'date_symptoms_started' => 'datetime',
    ];


    public function reportedLocation()
    {

        return $this->belongsTo(UserReportedLocation::class, 'user_reported_location_id', 'id');

    }


    public function user()
    {

        return $this->belongsTo(User::class);

    }


    public function setDateTestedAttribute($attr)
    {

        $this->attributes['date_tested'] = Carbon::createFromFormat('d/m/Y', $attr);

    }

    public function setDateSymptomsStartedAttribute($attr)
    {

        $this->attributes['date_symptoms_started'] = Carbon::createFromFormat('d/m/Y', $attr);

    }

}
