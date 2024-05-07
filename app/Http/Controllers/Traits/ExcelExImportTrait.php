<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait ExcelExImportTrait{
	public function export(Request $request)
	{
		$data = null;
		try {
			$data = $this->dataRepository->export($request);
			return $data->download();
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function import(Request $request) {
		$data = null;
		$data = $this->dataRepository->import($request);
		try {
			// return redirect()->back()->with('success', "Import success");
			return self::success("ok", $data);
		} catch (\Exception $e) {
			return self::success($e->getMessage(), $data);
		}
	}
}