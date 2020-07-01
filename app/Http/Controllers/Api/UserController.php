<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\CovidReportService;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCovidReportResource;
use App\Http\Controllers\Api\BaseController;


/**
 * @group  User
 *
 * API endpoints for managing user related information.
 */
class UserController extends BaseController
{

    public function __construct()
    {

        $this->middleware('JWTAuth')->except([
            //
        ]);

        $this->user = Auth::user();

    }


    /**
     * Returns the user
     *
     * @response {
     *  "user": {"user object"}
     * }
     */
    public function userResource()
    {

        return $this->response([
            'user' => new UserResource($this->user)
        ]);

    }


    /**
     * Returns the user gdpr consent
     *
     * @response {
     *  "gdpr_consented": "bool"
     * }
     */
    public function checkGdprConsent()
    {

        return $this->response([
            'gdpr_consented' => $this->user->gdpr_consented
        ], 200, 'success');

    }


    /**
     * Marks the users GDPR as consented. Returns 403 if already set.
     *
     * @response {
     *  "gdpr_consented": "bool"
     * }
     */
    public function consentToGdpr(Request $request)
    {

        if ($this->user->gdpr_consented) return $this->response([], 403, 'user_already_consented');

        $this->user->update([
            'gdpr_consented' => true
        ]);

        return $this->response([], 200, 'success');

    }


    /**
     * Returns all the users covid status reports.
     *
     * @response {
     *  "reports": "collection"
     * }
     */
    public function covidStatusReportsResource()
    {
        return $this->response([
            'reports' => UserCovidReportResource::collection($this->user->covidReports()->get())
        ]);
    }


    /**
     * Returns just the users latest covid status report.
     *
     * @response {
     *  "report": "{report object}"
     * }
     */
    public function latestCovidStatusReportResource()
    {
        return $this->response([
            'report' => new UserCovidReportResource($this->user->latestCovidReport()->first())
        ]);
    }


    /**
     * Create new covid report
     *
     * @bodyParam status string required Must be 'symptomatic', 'negative' or 'positive'.
     * @bodyParam gender string required
     * @bodyParam dob string required Must be 'd/m/Y' PHP format. See: https://www.php.net/manual/en/function.date.php.
     * @bodyParam city string required
     * @bodyParam county string required
     * @bodyParam country string required
     * @bodyParam date_tested string  Must be 'd/m/Y' PHP format. See: https://www.php.net/manual/en/function.date.php.
     * @bodyParam date_symptoms_started string  Must be 'd/m/Y' PHP format. See: https://www.php.net/manual/en/function.date.php.
     *
     * @response {
     *  "report": "{report object}"
     * }
     */
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


    /**
     * Update user settings. None of the parameters are required so you can update any of the following, or all, at the same time.
     *
     * @bodyParam name string
     * @bodyParam email string
     * @bodyParam gender string
     * @bodyParam dob string  Must be 'd/m/Y' PHP format. See: https://www.php.net/manual/en/function.date.php.
     * @bodyParam city string
     * @bodyParam county string
     * @bodyParam country string
     * @bodyParam phone string
     * @bodyParam gdpr_consented bool
     * @bodyParam notifications_on bool
     * @bodyParam autosharing_on bool
     * @bodyParam interested_ppe bool
     * @bodyParam interested_htk bool
     *
     * @response {
     *  "user": "{user object}"
     * }
     */
    public function updateUserSettings(Request $request)
    {
        return $this->response(['input' => $request->all()], 200, 'test_response');
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


    /**
     * Returns the users covid alert status
     *
     * @response {
     *  "status": "{report object}",
     *  "last_reported": "timestamp",
     * }
     */
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
