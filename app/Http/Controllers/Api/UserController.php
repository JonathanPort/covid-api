<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\CovidReportService;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCovidReportResource;
use App\Http\Controllers\Api\BaseController;

class UserController extends BaseController
{

    public function __construct()
    {

        $this->middleware('JWTAuth')->except([
            //
        ]);

        $this->user = Auth::user();

    }


    public function userResource()
    {

        return $this->response([
            'user' => new UserResource($this->user)
        ]);

    }


    public function checkGdprConsent()
    {

        return $this->response([
            'user_consented' => $this->user->gdpr_consented
        ], 200, 'success');

    }


    public function consentToGdpr(Request $request)
    {

        if ($this->user->gdpr_consented) return $this->response([], 403, 'user_already_consented');

        $this->user->update([
            'gdpr_consented' => true
        ]);

        return $this->response([], 200, 'success');

    }


    public function covidStatusReportsResource()
    {
        return $this->response([
            'reports' => UserCovidReportResource::collection($this->user->covidReports()->get())
        ]);
    }


    public function latestCovidStatusReportResource()
    {
        return $this->response([
            'report' => new UserCovidReportResource($this->user->latestCovidReport()->first())
        ]);
    }


    public function newCovidStatusReport(Request $request)
    {

        $service = new CovidReportService();

        try {
            $report = $service->newReport($request->all());
        } catch (\Exception $e) {

            return $this->response(
                ['validation_errors' => json_decode($e->getMessage())],
                422,
                'validation_error'
            );

        }


        return $this->response([
            'report' => new UserCovidReportResource($report),
        ], 200, 'success');


    }



    public function updateUserSettings(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users',
            'gender' => 'nullable|string',
            'dob' => 'nullable|date_format:d/m/Y',
            'city' => 'nullable|string',
            'county' => 'nullable|string',
            'country' => 'nullable|string',
            'gdpr_consented' => 'nullable|boolean',
            'phone' => 'nullable|string',
            'notifications_on' => 'nullable|boolean',
            'autosharing_on' => 'nullable|boolean',
            'interested_ppe' => 'nullable|boolean',
            'interested_htk' => 'nullable|boolean',
        ]);

        $messages = $validator->messages();

        if (count($messages)) return $this->response([
            'messages' => $validator->messages(),
        ], 422, 'validation_error');


        $this->user->update($request->all());

        return $this->response([
            'user' => new UserResource($this->user),
        ], 200, 'success');


    }



    public function getAlertStatus()
    {

        $report = $this->user->latestCovidReport()->first();

        $lastReported = $report ? $report->created_at : false;

        return $this->response([
            'status' => $report,
            'last_reported' => $lastReported,
        ], 200, 'success');

    }


}
