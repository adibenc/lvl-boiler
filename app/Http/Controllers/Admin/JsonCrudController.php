<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\DataRepository;
use Illuminate\Http\Request;

class JsonCrudController extends Controller
{
    protected $dataRepository;

    protected $blades = [
        "index" => "admin.data.index",
        "add" => "admin.data.add",
        "edit" => "admin.data.edit",
    ];
    
    public function __construct(
        DataRepository $dataRepository
    ) {
            $this->dataRepository = $dataRepository;
    }

    public function index(Request $request)
    {
        try {
            $data = $this->dataRepository->all();
            return view($this->blades['index'], compact('data'));
        } catch (\Exception $th) {
            return $th->getMessage();
            // return redirect()->route('admin.data.index')->with('error', $th->getMessage());
        }
    }

    public function all() {
        try {
            $data = $this->dataRepository->all();
            return self::success("OK", $data);
        } catch (\Exception $th) {
            return self::userFail($th->getMessage(), null);
        }
    }

    public function create()
    {
        $data = [
            "create"
        ];
        return view($this->blades['add'], $data);
    }

    public function store(Request $request) {
        $data = null;
        try {
            $attributes = $request->all();
            $user = auth()->user();
            $data = $data = $this->dataRepository
                ->validate("create", $request)
                ->store($request);

            return self::success("Ok", $data);
        } catch (\Exception $th) {
            return self::fail($th->getMessage(), $data);
        }
    }

    public function show($id) {
        $data = null;
        try {
            $data = $this->dataRepository->show($id);
            return self::success("Ok", $data);
        } catch (\Exception $e) {
            return self::fail($e->getMessage(), $data);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $data = $this->dataRepository->show($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return self::success("Ok", $data);
    }

    public function doUpdate(Request $request, $id){
        $data = null;
        try {
            $data = $this->dataRepository
                ->validate("update", $request)
                ->update($request, $id);
            return self::success("Updated", $data);
        } catch (\Exception $e) {
            // return redirect()->back()->with('error', $e->getMessage());
            return self::fail($e->getMessage(), $data);
        }
    }

    public function update(Request $request, $id)
    {
        return $this->doUpdate($request, $id);
    }

    public function destroy($id)
    {
        $data = null;
        try {
            $data = $this->dataRepository->destroy($id);
            return self::success("Deleted", $data);
        } catch (\Exception $e) {
            return self::fail($e->getMessage(), $data);
        }
    }

	public function myData() {
		$data = [];
		// try {
			$data = $this->dataRepository->myData();
			try {
			return self::success("ok", $data);
		} catch (\Exception $e) {
			return self::fail($e->getMessage(), $data);
		}
	}
}
