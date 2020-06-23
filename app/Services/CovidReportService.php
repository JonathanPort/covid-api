<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\UserReportedLocation;
use App\Models\UserCovidReport;

class CovidReportService
{

    public function newReport(array $formData)
    {

        $validator = Validator::make($formData, [
            'status' => 'required|in:symptomatic,negative,positive',
            'gender' => 'required|string',
            'dob' => 'required|date_format:d/m/Y',
            'city' => 'required|string',
            'county' => 'required|string',
            'country' => 'required|string',
            'date_tested' => 'nullable|date_format:d/m/Y',
            'date_symptoms_started' => 'nullable|date_format:d/m/Y',
        ]);

        $messages = $validator->messages();

        if (count($messages)) throw new \Exception(json_encode($messages));


        $report = new UserCovidReport();
        $user = Auth::user();


        $location = UserReportedLocation::create([
            'user_id' => $user->id,
            'city' => $formData['city'],
            'county' => $formData['county'],
            'country' => $formData['country'],
        ]);

        $report->user_id = $user->id;
        $report->user_reported_location_id = $location->id;
        $report->status = $formData['status'];

        switch ($formData['status']) {

            case 'negative':
                //
                break;
            case 'positive':
                $report->data_tested = $formData['date_tested'];
                break;
            case 'symptomatic':
                $report->date_symptoms_started = $formData['date_symptoms_started'];
                break;

        }

        $user->update([
            'dob' => $formData['dob'],
            'gender' => $formData['gender'],
        ]);

        if (! $user->city || ! $user->county || ! $user->country) {
            $user->update([
                'city' => $formData['city'],
                'county' => $formData['county'],
                'country' => $formData['country'],
            ]);
        }

        $report->save();

        return $report;

    }

}
