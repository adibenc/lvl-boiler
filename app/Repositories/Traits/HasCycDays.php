<?php

namespace App\Repositories\Traits;

trait HasCycDays{
	public $defaultCycDays = 21;
	/**
	 * Get the value of defaultCycDays
	 */ 
	public function getDefaultCycDays()
	{
		return $this->defaultCycDays;
	}

	/**
	 * Set the value of defaultCycDays
	 *
	 * @return  self
	 */ 
	public function setDefaultCycDays($defaultCycDays)
	{
		$this->defaultCycDays = $defaultCycDays;

		return $this;
	}
}