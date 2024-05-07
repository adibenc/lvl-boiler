<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Admin\JsonCrudController;
use App\Models\ProtocolDetail;
use App\Models\ProtoSession;
use App\Models\ProtoSessionDetail;
use App\Repositories\ProtoSessionRepository;
use Illuminate\Http\Request;

class ProtoSessionController extends JsonCrudController
{

	public function __construct(
		ProtoSessionRepository $dataRepository
	) {
		$this->dataRepository = $dataRepository;
		// $this->middleware("roles:sys"); // todo
	}

	public function show($id = null)
	{
		$data = [];
		try {
			$id = auth()->user()->id;
			$data = $this->dataRepository->show($id);

			return self::success("Ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
	
	public function showDetail($id = null) {
		$data = [];
		try {
			$user = auth()->user();
			$data = ProtoSession::with([
					"psDetail",
					"organ:id,name,code",
				])
				->where("id", $id)
				->first();

			if($user->id != $data->user_id){
				throw new \Exception("Not yours!");
			}

			return self::success("Ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), null);
		}
	}

	public function attend($id = null, $detailId = null) {
		$data = [];
		try {
			$user = auth()->user();
			$data = ProtoSession::with(["psDetail"])
				->where("id", $id)
				->first();

			if($user->id != $data->user_id){
				throw new \Exception("Not yours!");
			}

			$psd = ProtoSessionDetail::where("id", $detailId)->first();

			if($psd->authorized != 1){
				throw new \Exception("Sesi kemo belum diotorisasi dokter! Mohon hubungi dokter anda!");
			}
			$psd->attd = 1;
			$psd->att_at = now();
			$psd->save();

			return self::success("Ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), null);
		}
	}
}
