<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Admin\JsonCrudController;
use App\Models\ProtocolDetail;
use App\Models\ProtoSession;
use App\Models\ProtoSessionDetail;
use App\Models\User;
use App\Repositories\ProtoSessionRepository;
use Illuminate\Http\Request;
use DB;

class HomeController extends JsonCrudController
{

	public function __construct(
		ProtoSessionRepository $dataRepository
	) {
		$this->dataRepository = $dataRepository;
		// $this->middleware("roles:sys"); // todo
	}

	public function home(){
		$data = [];
		try {
			$user = auth()->user();
			/* $user = User::where("role", "member")
				->first(); */
			$last = $user->myLastSession()
				->select(DB::raw(<<<SQL
					u.id, u.username, 
					ud.name as doctor_name,
					ps.*, psd.*
				SQL))
				->get()->first();
			$next = $user->myNextSession()
				->select(DB::raw(<<<SQL
					u.id, u.username, 
					ud.name as doctor_name,
					ps.*, psd.*
				SQL))
				->get()->first();
			

			return self::success("Ok", [
				"last" => $last,
				"next" => $next,
			]);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
}
