<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Admin\JsonCrudController;
use App\Repositories\ProtoSessionDetailRepository;
use App\Repositories\UserRepository;
use App\Services\ZenvivaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotifyController extends JsonCrudController {
	public $zenvSvc;

    public function __construct(
        UserRepository $dataRepository,
		ProtoSessionDetailRepository $protoSessionDetailRepository,
		ZenvivaService $zenvSvc
    ) {
        $this->dataRepository = $dataRepository;
        $this->protoSessionDetailRepository = $protoSessionDetailRepository;
        $this->zenvSvc = $zenvSvc;
        // $this->middleware("roles:sys"); // todo
    }

	public function notifyWA() {
		$data = [];
		try {
			Log::info( "znv::init notif" );
			$data = $this->protoSessionDetailRepository
				// ->getTommorowSessions();
				->getFutureSessions();
				// try {
			foreach($data as $i => $d){
				try{
					$username = $d['username'];
					if(!$d['phone']){
						throw new \Exception("Notif wa :: Null phone number for $username");
					}
					$res = $this->zenvSvc->sendWA($d['phone'], $d['msg']);
					Log::info( presonRet($res) );
				}catch(\Exception $e){
					Log::error($e->getMessage());
				}
			}

			$dl = sizeof($data);

			Log::info( "notif znv to $dl wa numbers sent" );
			
			return self::success("Ok", $data);
		} catch (\Exception $e) {
			$emsg = $e->getMessage();
			Log::info( $emsg );
			return self::fail($emsg, $data);
		}
	}
	
	public function stat() {
		$data = [];
		try {
			$l = storage_path("logs/laravel.log");
			$kw = "";
			$abZ = shell_exec("grep -A 5 -in 'zenziva' $l");
			$data = $abZ;
			
			return self::success("Ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
}
