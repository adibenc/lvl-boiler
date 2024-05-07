<?php

namespace App\Repositories\Traits;

use DB;
use Exception;
use App\Services\Keyword;
use App\Constants\PaginatorConst;
use Illuminate\Pagination\Paginator;
use Log;

trait CRUDRepoTrait{
    public $model;

    public function setModel($model){
		$this->model = $model;

		return $this;
    }
    
    public function logs($data){
        return Log::info($data);
    }

    public function logsEvent($data){
        $user = auth()->user();
        return $this->logs(json_encode([
            "username" => $user->username,
            "data" => $data,
        ]));
    }

    public function insertData($attributes){
        return [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
        ];
    }

    public function updateData($attributes){
        return [
            'name' => $attributes->name,
            'email' => $attributes->email
        ];
    }

    /**
     * get all $this->model
     *
     * @return void
     */
    public function all()
    {
        $datas = $this->model::all();
        return $datas;
    }

    /**
     * Create data.
     *
     * @param array $attributes
     * @return $this->model
     */
    public function store($attributes)
    {
        $data = $this->model::create($this->insertData($attributes));
        $this->onCreated($data);
        
        return $data;
    }

    /**
     * get data
     *
     * @return void
     */
    public function show($id)
    {
        $data = $this->model::find($id);
        if (empty($data)) {
            throw new Exception((string)$this->model." not found");
        }
        return $data;
    }

    public function edit($id)
    {
        $data = $this->model::find($id);
        
        return $data;
    }

    public function allowDelete($data){
        return true;
    }
    
    public function doUpdate($dbData, $data){
        $dbData->update($data);
        return $dbData;
    }

    /**
     * update data
     *
     * @param [type] $request
     * @param [type] $id
     * @return void
     */
    public function update($request, $id)
    {
        $dbData = $this->model::find($id);

        if (empty($dbData)) {
            throw new Exception($this->model." not found");
        }

        DB::beginTransaction();
        try {
            $data = $this->updateData($request->all());
            $update = $this->doUpdate($dbData, $data);
            
            DB::commit();
            $this->onUpdated($dbData);
            
            return $dbData;
        } catch (\Exception $th) {
            DB::rollback();
            throw new Exception($th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = $this->model::find($id);

        DB::beginTransaction();
        if (empty($data)) {
            throw new Exception((string)$this->model." not found");
        }

        if(!$this->allowDelete($data)){
            throw new Exception("Not allowed!");
        }

        $data->delete();
        $this->onDeleted($data);
        
        DB::commit();

        return true;
    }

    public function onCreated($data = null){
        return;
    }

    public function onUpdated($data = null){
        return;
    }

    public function onDeleted($data = null){
        return;
    }

	// my data
	function myData(){
		$me = auth()->user();

		// return $me->myProtoSession;
		return $me->data;
	}
}