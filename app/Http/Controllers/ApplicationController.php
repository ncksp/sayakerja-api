<?php

namespace App\Http\Controllers;

use App\Application;
use App\Company;
use App\Http\RequestValidator;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //

    public function my_application($id)
    {
        $application = Application::where('user_id', $id)->with(['company','user'])->get();

        if ($application == null)
            return $this->json_response(true, 'You dont have application', null, 200);

        return $this->json_response(true, 'Your application', $application, 200);
    }

    public function application_to_user_company($id)
    {
        $company = Company::where('user_id', $id)->first();
        if (is_null($company))
            return $this->json_response(true, 'You should have an company', null, 200);

        $company_id = $company->toArray()["id"];
        $application = Application::where('company_id', $company_id)->get();
        return $this->json_response(true, 'List of application has been applied in your company', $application, 200);
    }

    public function store(Request $request)
    {
        $validator = new RequestValidator();
        $validation = $validator->application_data_validator($request);

        if ($validation->fails())
            return $this->json_response(false, "Fill the required field", $validation->errors(), 400);
        $post = Application::create($request->toArray());

        if (!$post)
            return $this->json_response(false, 'Error when save data application', null, 500);

        return $this->json_response(true, 'Success save data application', null, 200);
    }
}
