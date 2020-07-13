<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\AppDataPointService;
use App\Models\AppDataPoint;
use App\Http\Controllers\Api\BaseController;

/**
 * @group  App Data Points
 *
 * API endpoints for retrieving general app data via API set in the admin panel.
 */
class AppDataPointsController extends BaseController
{


    public function __construct()
    {
        //
    }

    /**
     * Get app data from data point
     *
     * @bodyParam data_point string required The key of the data
     *
     * @response {data: data_content}
     */
    public function getAppData(Request $request)
    {

        $validator = Validator::make(['data_point' => $request->data_point], [
            'data_point' => 'required|alpha_dash',
        ]);

        if ($validator->fails()) return $this->response([
            'messages' => ['data_point' => 'Datapoint is a required alpha_dash string. Refer to Laravel validation rules.']
        ], 422, 'validation_error');


        $service = new AppDataPointService();

        try {

            $data = $service->retrieveDataFromPoint($request->data_point);

        } catch (\Exception $e) {

            return $this->response([], 204, 'no_content');

        }


        return $this->response([
            'data' => $data,
        ], 200, 'success');

    }

}
