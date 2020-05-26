<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\RequestValidator;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index()
    {
        $companies = Company::all();

        return $this->json_response(true, 'List of Company', $companies, 200);
    }

    public function show($id)
    {
        $company = Company::find($id);
        if (is_null($company))
            $company = array(null);
        return $this->json_response(true, 'Data of Company', $company, 200);
    }

    public function store(Request $request)
    {
        $validator = new RequestValidator();
        $validation = $validator->company_data_validator($request);

        if ($validation->fails())
            return $this->json_response(false, "Fill the required field", $validation->errors(), 400);

        $check = Company::where('user_id', $request->user_id)->get();
        if ($check != null)
            return $this->json_response(false, "User already has company", null, 400);

        $post = Company::create($request->toArray());

        if (!$post)
            return $this->json_response(false, 'Error when save data company', null, 500);

        return $this->json_response(true, 'Success save data company', null, 200);
    }

    public function update($id, Request $request)
    {
        $validator = new RequestValidator();
        $validation = $validator->company_data_validator($request);

        if ($validation->fails())
            return $this->json_response(false, "Fill the required field", $validation->errors(), 400);

        $post = Company::whereId($id)->update($request->toArray());

        if (!$post)
            return $this->json_response(false, 'Error when edit data company', null, 500);

        return $this->json_response(true, 'Success edit data company', null, 200);
    }

    public function destroy($id)
    {
        $user = Company::find($id);

        if (!$user)
            return $this->json_response(false, "Company not found", null, 400);

        $user->forceDelete();

        return $this->json_response(true, "Company has been deleted", null, 200);
    }

    public function user_company($id)
    {
        $company = Company::where('user_id', $id)->first();
        if (is_null($company))
            return $this->json_response(true, 'You should have an company', null, 200);

        return $this->json_response(true, 'Data of your company', $company, 200);
    }

    public function jobs($id)
    {
        $jobs = Company::find($id)->jobs;
        if (is_null($jobs))
            return $this->json_response(true, 'You should have an company', null, 200);

        return $this->json_response(true, 'Jobs in this company', $jobs, 200);
    }
}
