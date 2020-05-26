<?php

namespace App\Http\Controllers;

use App\Application;
use App\Company;
use App\User as ModelUser;
use App\UserDetail;
use App\UserSkill;
use App\Http\RequestValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    private function set_user_data($request)
    {
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];
        return $data;
    }

    private function set_user_details_data($id, $request)
    {
        $data = [
            "gender" => $request->gender,
            'address' => $request->address,
            'resume' => $request->resume,
            'phone' => $request->phone,
        ];
        if ($id != null)
            $data["user_id"] = $id;
        return $data;
    }

    private function set_user_skill_data($id, $skill)
    {
        $data = [
            "skill" => trim($skill, ' ')
        ];

        if ($id != null)
            $data["user_id"] = $id;
        return $data;
    }

    public function index()
    {
        $users = ModelUser::all();
        return $this->json_response(true, "List user", $users, 200);
    }

    public function show($id)
    {
        try {
            $users = ModelUser::find($id)->toArray();
            $details = ModelUser::find($id)->details->toArray();
            $skills = ModelUser::find($id)->skills->toArray();
        } catch (\Throwable $th) {
            //throw $th;
            $users = $details = $skills = array();
        }

        $result = array_merge($users, $details);
        $skills = array_column($skills, "skill");
        $data = [
            "details" => $result,
            "skills" => $skills
        ];
        return $this->json_response(true, "User Details", $data, 200);
    }

    public function store(Request $request)
    {
        $validator = new RequestValidator();
        $validation = $validator->user_data_validator($request);

        if ($validation->fails())
            return $this->json_response(false, "Fill the required field", $validation->errors(), 400);

        $user = ModelUser::create($this->set_user_data($request));

        if (!$user)
            return $this->json_response(false, "Error when save data user", null, 500);

        $user_detail = UserDetail::create($this->set_user_details_data($user->id, $request));

        if (!$user_detail)
            return $this->json_response(false, "Error when save data user", null, 500);

        $skills = explode(",", $request->skill);
        foreach ($skills as $skill) {
            $user_skill = UserSkill::create($this->set_user_skill_data($user->id, $skill));
            if (!$user_skill)
                return $this->json_response(false, "Error when save data user", null, 500);
        };

        return $this->json_response(true, "save data user success", null, 200);
    }

    public function update($id, Request $request)
    {
        $validator = new RequestValidator();
        $validation = $validator->user_data_validator($request);

        if ($validation->fails())
            return $this->json_response(false, "Fill the required field", $validation->errors(), 400);

        $user = ModelUser::whereId($id)->update($this->set_user_data($request));

        if (!$user)
            return $this->json_response(false, "Error when update data user", null, 500);

        $user_detail = UserDetail::where('user_id', $id)->update($this->set_user_details_data(null, $request));

        if (!$user_detail)
            return $this->json_response(false, "Error when update data user", null, 500);

        $skills = explode(",", $request->skill);
        UserSkill::where('user_id', $id)->forceDelete();
        foreach ($skills as $skill) {
            $user_skill = UserSkill::create($this->set_user_skill_data($id, $skill));
            if (!$user_skill)
                return $this->json_response(false, "Error when update data user", null, 500);
        };

        return $this->json_response(true, "update data user success", null, 200);
    }

    public function destroy($id)
    {
        $user = ModelUser::find($id);

        if (!$user)
            return $this->json_response(false, "User not found", null, 400);

        $user->forceDelete();

        return $this->json_response(true, "User has been deleted", null, 200);
    }
}
