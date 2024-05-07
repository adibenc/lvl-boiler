<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ContactsRepository;
use Illuminate\Http\Request;

class ContactsController extends JsonCrudController
{
    protected $blades = [
        "index" => "admin.contacts.index",
        "add" => "admin.contacts.add",
        "edit" => "admin.contacts.edit",
    ];
    
    public function __construct(
        ContactsRepository $dataRepository
    ) {
        $this->dataRepository = $dataRepository;
        $this->middleware("roles:superadmin|admin");
    }

    public function index(Request $request){
        try {
            $user = auth()->user();
            $data = [];

            return view($this->blades['index'], compact('data'));
        } catch (\Exception $th) {
            return $th->getMessage();
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
