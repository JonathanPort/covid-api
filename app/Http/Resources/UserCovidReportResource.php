<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCovidReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $arr = [
            'reported_on' => $this->created_at,
            'status' => $this->status,
            'reported_location' => $this->reportedLocation()->first(),
        ];

        switch ($this->status) {

            case 'negative':
                //
                break;
            case 'positive':
                $arr['date_tested'] = $this->date_tested;
                break;
            case 'symptomatic':
                $arr['date_symptoms_started'] = $this->date_symptoms_started;
                break;

        }

        return $arr;
    }
}
