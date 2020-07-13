<?php

namespace App\Services;

use App\Models\AppDataPoint;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AppDataPointService
{

    public function retrieveDataFromPoint(string $uri)
    {

        $validator = Validator::make(['uri' => $uri], [
            'uri' => 'required|alpha_dash',
        ]);

        if (! $validator->validate()) throw new \Exception('validation_error', 422);

        $data = AppDataPoint::where('uri', $uri)->first();

        if (! $data) throw new \Exception('data_not_found', 204);

        return $data->content;

    }

}
