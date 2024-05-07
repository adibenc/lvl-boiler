<?php

namespace App\Http\Controllers\Admin\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Contracts\IDatatable;

abstract class DTControllerBase extends Controller{
    protected $model = '';
    protected $wheres = [];

    public function __construct(){
        $this->middleware('auth');
    }

    static function isValidParam($data){
        return $data && $data !== "-" && !empty($data);
    }

    public function get(){
        return datatables()->of($this->model::query()->orderBy('id',"desc"))->toJson();
    }

    public function where(){
        $where=[];
        return datatables()->of($this->model::where($where)->get())->toJson();
    }

	public function getWheres(){
		return $this->wheres;
	}

	public function setWheres($wheres){
		$this->wheres = $wheres;

		return $this;
	}

    public function addWheres($key, $val){
		$this->wheres[$key] = $val;

		return $this;
	}
}
