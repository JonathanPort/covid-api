<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Socialite\AbstractUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Exception;
use Carbon\Carbon;
use App\Models\UserReportedLocation;
use App\Models\Concerns\UsesUuid;

class User extends Authenticatable implements JWTSubject
{

    use UsesUuid;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gdpr_consented', 'gender', 'dob',
        'city', 'county', 'country', 'phone', 'notifications_on', 'autosharing_on',
        'interested_ppe', 'interested_htk',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function ssoAccounts()
    {

        return $this->hasMany(UserSsoAccount::class);

    }


    public function createSsoAccount(AbstractUser $ssoData, string $providerName)
    {

        // Check if account exists
        $existing = UserSsoAccount::where('provider_id', $ssoData->getId())->first();

        if ($existing) throw new Exception('SSO Account already exists for this user.');

        return UserSsoAccount::create([
            'provider_id' => $ssoData->getId(),
            'provider_name' => $providerName,
            'user_id' => $this->id,
        ]);

    }

    public function reportedLocations()
    {

        return $this->hasMany(UserReportedLocation::class);

    }


    public function covidReports()
    {

        return $this->hasMany(UserCovidReport::class);

    }


    public function latestCovidReport()
    {

        return $this->hasMany(UserCovidReport::class)->orderBy('created_at', 'desc');

    }


    public function setDobAttribute($attr)
    {

        return Carbon::createFromFormat('d/m/Y', $attr);

    }


}
