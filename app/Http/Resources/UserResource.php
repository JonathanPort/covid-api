<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'name' => $this->name,
            'email' => $this->email,
            'gdpr_consented' => $this->gdpr_consented,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'city' => $this->city,
            'county' => $this->county,
            'country' => $this->country,
            'phone' => $this->phone,
            'notifications_on' => $this->notifications_on,
            'autosharing_on' => $this->autosharing_on,
            'interested_ppe' => $this->interested_ppe,
            'interested_htk' => $this->interested_htk,
            'sso_accounts' => $this->ssoAccounts()->get(),
            'latest_covid_report' => new UserCovidReportResource($this->latestCovidReport()->first()),
            'all_covid_reports' => UserCovidReportResource::collection($this->covidReports()->get()),
            'reported_locations' => $this->reportedLocations()->get(),
            'created_at' => $this->created_at,
        ];

    }
}
