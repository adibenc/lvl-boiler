<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\DataRepository;
use Illuminate\Http\Request;

class CrudController extends Controller
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

    public function create()
    {
        $data = [
            "create"
        ];
        return view($this->blades['add'], $data);
    }

    public function store(Request $request)
    {
        $data = $this->dataRepository->store($request);
        return redirect()->route('admin.data.index')->with('message', 'Data berhasil di simpan');
    }

    public function show($id)
    {
        try {
            $data = $this->dataRepository->show($id);
            return view("admin.data.show", $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $data = $this->dataRepository->show($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view($this->blades['edit'], compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->dataRepository->update($request, $id);
            return redirect()->back()->with('message', 'Data berhasil di update');
        } catch (\Exception $e) {
            // return redirect()->back()->with('error', $e->getMessage());
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $data = $this->dataRepository->destroy($id);
            return redirect()->back()->with('message', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
