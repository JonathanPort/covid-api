<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\ContactFormService;
use App\Http\Resources\DefaultContactFormResource;
use App\Http\Controllers\Api\BaseController;


/**
 * @group  Contact Forms
 *
 * API endpoints for managing contact forms
 */
class ContactFormController extends BaseController
{


    public function __construct()
    {

        $this->middleware('JWTAuth')->except([
            //
        ]);

        $this->user = Auth::user();

    }


    /**
     * Create new contact form submission.
     *
     * @bodyParam form_name string required Right now there is only one form so 'default' will do. If needed later, more forms can be made.
     * @bodyParam full_name string required
     * @bodyParam email string required Must be a valid email address.
     * @bodyParam subject string required
     * @bodyParam message string required Max: 500 chars.
     *
     * @response {
     *  "submission": "{form submission object}"
     * }
     */
    public function newFormSubmission(Request $request)
    {

        $service = new ContactFormService();

        try {
            $submission = $service->newFormSubmission($request->all());
        } catch (\Exception $e) {

            return $this->response(
                ['validation_errors' => json_decode($e->getMessage())],
                422,
                'validation_error'
            );

        }


        return $this->response([
            'submission' => new DefaultContactFormResource($submission),
        ], 200, 'success');

    }

}
