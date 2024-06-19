<?php

namespace App\Api;

trait PostsTrait
{
    public function apiResponse($data=null, $status = null, $message = null)
    {
        $array = [
            'data' => $data,
            'status' =>   $status ,
            'message' => ucwords($message) ,
        ];
        return response()->json($array);
    }
}
