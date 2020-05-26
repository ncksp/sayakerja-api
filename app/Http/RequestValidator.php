<?php

namespace App\Http;

use Illuminate\Support\Facades\Validator;

class RequestValidator
{
    public function user_data_validator($request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'gender' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'required',
            'email.required' => 'required',
            'password.required' => 'required and must be 8 characters or more',
            'password.min' => 'must be 8 characters or more',
            'gender.required' => 'required',
            'address.required' => 'required',
            'phone.required' => 'required',
        ]);

        return $validation;
    }

    public function company_data_validator($request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'user_id' => 'required|numeric',
            'contact' => 'required',
        ], [
            'name.required' => 'required',
            'user_id.required' => 'required',
            'address.required' => 'required',
            'contact.required' => 'required',
        ]);

        return $validation;
    }

    public function job_data_validator($request)
    {
        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'description' => 'required',
        ], [
            'user_id.required' => 'required',
            'name.required' => 'required',
            'position.required' => 'required',
            'salary.required' => 'required',
            'description.required' => 'required',
        ]);

        return $validation;
    }

    public function application_data_validator($request)
    {
        $validation = Validator::make($request->all(), [
            'company_id' => 'required',
            'user_id' => 'required|numeric',
            'additional' => 'required',
        ], [
            'company_id.required' => 'required',
            'user_id.required' => 'required',
            'additional.required' => 'required',
        ]);

        return $validation;
    }
}
