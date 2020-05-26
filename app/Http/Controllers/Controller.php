<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function json_response($status, $message, $data = null, $http_code){
        $response = [
            'success' => $status,
            'message' => $message,
        ];

        if($data != null)
            $response["data"] = $data;
        return response()->json($response, $http_code);
    }
}
