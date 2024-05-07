<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	static function getRaw(){
		return file_get_contents("php://input");
	}

    static function getRawDecoded(){
		return json_decode(self::getRaw());
	}
	
    static function stdJson($success = true, $msg = "", $data = []){
        return [
            "success" => $success,
            "message" => $msg,
            "data" => $data
        ];
    }

    static function jsonResp($data = [], $code = null){
        $code = $code ?? 200;
        return response()->json($data, $code);
    }

    static function success($msg = "", $data = []){
        return response()->json(self::stdJson(true, $msg, $data), 200);
    }

    static function fail($msg = "", $data = []){
        return response()->json(self::stdJson(false, $msg, $data), 500);
    }

	static function unim(){
		return "unimplemented";
	}
}
