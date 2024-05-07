<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Admin\JsonCrudController;
use App\Repositories\ProtoSessionDetailRepository;
use App\Repositories\UserRepository;
use App\Services\AppStrapi;
use App\Services\ZenvivaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Dbfx\LaravelStrapi\LaravelStrapi;

class ContentsController extends JsonCrudController {
	public $zenvSvc;

    public function __construct(
        UserRepository $dataRepository,
		AppStrapi $appStrapi
    ) {
        $this->dataRepository = $dataRepository;
        $this->appStrapi = $appStrapi;
        // $this->middleware("roles:sys"); // todo
    }

	public function paged() {
		$data = [];
		try {
			// $strapi = new AppStrapi();
			
			$data = $this->appStrapi->collection('contents');
			// $entry = $strapi->entry('blogs', 1);

			return self::success("Ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
	
	public function single($id) {
		$data = [];
		try {
			// $strapi = new AppStrapi();
			
			$data = $this->appStrapi->getSingle("contents", $id);
			// $entry = $strapi->entry('blogs', 1);

			return self::success("Ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
}
