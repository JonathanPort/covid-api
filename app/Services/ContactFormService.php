<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\DefaultContactFormSubmission;

class ContactFormService
{

    public function newFormSubmission(array $formData)
    {

        $formName = isset($formData['form_name']) ? $formData['form_name'] : 'default';

        switch ($formName) {

            // Other form validations go here

            default:

                $validator = Validator::make($formData, [
                    'full_name' => 'required|string',
                    'email' => 'required|email',
                    'subject' => 'required|string',
                    'message' => 'required|string|max:500',
                ]);

        }

        $messages = $validator->messages();

        if (count($messages)) throw new \Exception(json_encode($messages));


        switch ($formName) {

            // Other form models go here

            default:

                $model = DefaultContactFormSubmission::create($formData);

        }


        return $model;


    }

}
