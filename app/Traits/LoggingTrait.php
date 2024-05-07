<?php

namespace App\Traits;

use Log;

trait LoggingTrait{
    
    public function logs($data){
        return Log::info($data);
    }

    public function logsEvent($data){
        $user = auth()->user();
        return $this->logs(json_encode([
            "username" => $user->username,
            "data" => $data,
        ]));
    }
}