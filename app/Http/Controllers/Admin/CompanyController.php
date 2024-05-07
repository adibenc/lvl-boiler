<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends JsonCrudController
{
    protected $blades = [
        "index" => "admin.company.index",
        "add" => "admin.company.add",
        "edit" => "admin.company.edit",
    ];
    
    public function __construct(
        CompanyRepository $dataRepository
    ) {
        $this->dataRepository = $dataRepository;
        $this->middleware("roles:superadmin|admin|manager");
    }

    public function index(Request $request){
        try {
            $user = auth()->user();
            $lembaga = (new Tag)->lembaga()->get();
            $data = [];

            return view($this->blades['index'], compact('data', 'lembaga'));
        } catch (\Exception $th) {
            return $th->getMessage();
            // return redirect()->route('admin.data.index')->with('error', $th->getMessage());
        }
    }

    public function store(Request $request) {
        $data = null;
        try {
            $attributes = $request->all();
            $user = auth()->user();
            $data = $this->dataRepository->store($attributes);

            return self::success("Ok", $data);
        } catch (\Exception $th) {
            return self::fail($th->getMessage(), $data);
        }
    }

    public function doUpdate(Request $request, $id){
        $data = null;
        // to do : validate
        try {
            $data = $this->dataRepository->update($request, $id);
            return self::success("Updated", $data);
        } catch (\Exception $e) {
            // return redirect()->back()->with('error', $e->getMessage());
            return self::fail($e->getMessage(), $data);
        }
    }
}
