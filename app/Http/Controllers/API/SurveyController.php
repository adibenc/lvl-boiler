<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\JsonCrudController;
use App\Models\ProtocolDetail;
use App\Models\ProtoSession;
use App\Models\ProtoSessionDetail;
use App\Repositories\SurveyRepository;

class SurveyController extends JsonCrudController
{

	public function __construct(
		SurveyRepository $dataRepository
	) {
		$this->dataRepository = $dataRepository;
		// $this->middleware("roles:sys"); // todo
	}

	public function show($id = null) {
		$data = [];
		try {
			$id = auth()->user()->id;
			$data = $this->dataRepository->show($id);

			return self::success("Ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
	
	public function showFactp() {
		$data = [];
		try {
			$data = $this->dataRepository->getFactp();

			return self::success("Ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}

	public function submitFactp(Request $req) {
		$data = [];
		try {
			// wip
			$decoded = self::getRawDecoded();
			if(!$decoded){
				$d = self::getRaw();
				$size = strlen($d);
				throw new \Exception("Invalid json received. len:($size)");
			}
			
			$psd_id = $decoded->psd_id;
			$subDetail = $decoded->sub_detail; // submission detail
			$data = $this->dataRepository->submitFactpSurvey($psd_id, $subDetail);

			return self::success("Ok", $data);
		} catch (QueryException $e) {
			$code = $e->getCode();
			$isDuplicate = $code == 23000;
			$msg = $e->getMessage();

			if($isDuplicate){
				$msg = "Kuesioner sudah pernah diisi!";
			}

			return self::fail($msg, $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
	
}
