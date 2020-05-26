<?php

namespace App\Http\Controllers;

use App\Http\RequestValidator;
use App\Job;
use App\Company;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();

        return $this->json_response(true, 'List of Jobs', $jobs, 200);
    }

    public function show($id)
    {
        $job = Job::find($id);
        if (is_null($job)){
            $job = array(null);
            return $this->json_response(true, 'Data of Job', $job, 200);
        }
        $company = $job->company;
        $job["company"] = $company;
        return $this->json_response(true, 'Data of Job', $job, 200);

    }

    public function store(Request $request)
    {
        $validator = new RequestValidator();
        $validation = $validator->job_data_validator($request);

        if ($validation->fails())
            return $this->json_response(false, "Fill the required field", $validation->errors(), 400);

        $company = Company::where('user_id', $request->user_id)->first()->toArray();

        if ($company == null)
            return $this->json_response(false, "User must be has company first", null , 400);

        $company_id = $company["id"];
        $request = $request->toArray();
        $request["company_id"] = $company_id;
        $post = Job::create($request);

        if (!$post)
            return $this->json_response(false, 'Error when save data job', null, 500);

        return $this->json_response(true, 'Success save data job', null, 200);
    }

    public function update($id, Request $request)
    {
        $validator = new RequestValidator();
        $validation = $validator->job_data_validator($request);

        if ($validation->fails())
            return $this->json_response(false, "Fill the required field", $validation->errors(), 400);

        $post = Job::whereId($id)->update($request->toArray());

        if (!$post)
            return $this->json_response(false, 'Error when edit data job', null, 500);

        return $this->json_response(true, 'Success edit data job', null, 200);
    }

    public function destroy($id)
    {
        $user = Job::find($id);

        if (!$user)
            return $this->json_response(false, "Company not found", null, 400);

        $user->forceDelete();

        return $this->json_response(true, "Company has been deleted", null, 200);
    }
}
