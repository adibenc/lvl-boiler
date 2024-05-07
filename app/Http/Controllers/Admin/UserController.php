<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Traits\ExcelExImportTrait;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends JsonCrudController
{
	use ExcelExImportTrait;

    protected $blades = [
        "index" => "admin.user.index",
        "add" => "admin.user.add",
        "edit" => "admin.user.edit",
    ];
    
    public function __construct(
        UserRepository $dataRepository
    ) {
        $this->dataRepository = $dataRepository;
        $this->middleware("roles:superadmin|admin");
    }

    public function index(Request $request){
        try {
            $user = auth()->user();
            $roles = User::ROLES;

            return view($this->blades['index'], compact('roles'));
        } catch (\Exception $th) {
            return $th->getMessage();
            // return redirect()->route('admin.data.index')->with('error', $th->getMessage());
        }
    }

	public function import(Request $request) {
		$data = null;
		try {
			$data = $this->dataRepository->import($request);
			// return redirect()->back()->with('success', "Import success");
			return self::success("ok", [
				$data,
				$this->dataRepository->getImportObj()
			]);
		} catch (QueryException $e) {
			$code = $e->getCode();
			$isDuplicate = $code == 23000;
			$msg = $e->getMessage();

			if($isDuplicate){
				$msg = "Ada data duplikat di kolom tertentu. Mohon cek ulang file anda!";
			}

			return self::fail($msg, $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
}
