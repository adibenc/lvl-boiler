<?php

namespace App\Repositories\Traits;

use Maatwebsite\Excel\Facades\Excel;

trait ExImportTraitRep{
	public $importObj;
	/*
	plz specify & change null to import class 
	compatible with Maatwebsite\Excel\Concerns\*
	xample: UsersImport::class 
	*/
	public function getImportClass() {
		return null;
	}

	public function export($attributes) {
		return (new $this->model());
	}

	public function import($attributes) {
		// get file excel upload
		$file = $attributes["file"];
		$class = $this->getImportClass();
		
		// return (new $class)->import($file);
		$cl = new $class;
		$this->importObj = $cl;
		return Excel::import($cl, $file);
	}

	/**
	 * Get the value of importObj
	 */ 
	public function getImportObj()
	{
		return $this->importObj;
	}

	/**
	 * Set the value of importObj
	 *
	 * @return  self
	 */ 
	public function setImportObj($importObj)
	{
		$this->importObj = $importObj;

		return $this;
	}
}