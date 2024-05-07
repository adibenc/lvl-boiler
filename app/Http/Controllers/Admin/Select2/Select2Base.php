<?php

namespace App\Http\Controllers\Admin\Select2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Traits\HasOutlet;
use Illuminate\Support\Arr;

abstract class Select2Base extends Controller{

	protected $model = '';
	protected $wheres = [];

	protected $builder;

	public function __construct()
	{
		$this->middleware('auth');
		// $this->setOutletFromDB();
	}

	static function isValidParam($data) {
		return $data && $data !== "-" && !empty($data);
	}

	public function setupBuilder($q) {
		return null;
	}

	public function getQLike() {
        try {
            $q = Arr::get($_GET, "q");
            if (!$q) {
                return self::success("Ok", []);
            }

            $data = $this->setupBuilder($q);

            return self::success("Ok", $data);
        } catch (\Exception $e) {
            return self::fail($e->getMessage(), null);
        }
    }

	/**
	 * Get the value of builder
	 */ 
	public function getBuilder()
	{
		return $this->builder;
	}

	/**
	 * Set the value of builder
	 *
	 * @return  self
	 */ 
	public function setBuilder($builder)
	{
		$this->builder = $builder;

		return $this;
	}
}
