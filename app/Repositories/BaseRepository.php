<?php

namespace App\Repositories;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseRepository
{
	protected $cacheExpired = 300; // 6*50 = 5 minutes in seconds
	protected $mainTable = "users"; // 6*50 = 5 minutes in seconds

	protected $eventService;
	const YMDHIS = "Y-m-d H:i:s";
	
	protected function getMainDB(){
		return DB::table($this->mainTable);
	}

	protected function reconnectAndNoStrict(){
		DB::disconnect('mysql');
		config()->set('database.connections.mysql.strict', false);
		DB::reconnect('mysql');
	}

	public function now(){
		return Carbon::now();
	}

	/**
	 * this now formatted Y-m-d H:i:s
	 * 
	 */
	public function stdNow(){
		return $this->now()->format("Y-m-d H:i:s");
	}

	public function toYmdhis($d){
		return Carbon::parse($d)->format("Y-m-d H:i:s");
	}
	
	public function toYmd($d){
		return Carbon::parse($d)->format("Y-m-d");
	}

	// $now = Carbon::now()->addDay(-30)->format("Y-m-d H:i:s");

	public function getEventService(){
		return $this->eventService;
	}

	public function setEventService($eventService){
		$this->eventService = $eventService;

		return $this;
	}

	function baseValidate(Request $req, $rule){
		$validator = Validator::make($req->all(), $rule);

		if($validator->fails()){
			throw new \Exception(
				implode(", ", 
					array_map(function($e){
						return $e[0];
				}, array_values($validator->errors()->getMessages())))
			);
		}

		return $validator;
	}

	// abstract function validate($type, Request $data);
	// /*
	// common implementation
	public function validate($type, $data){
		switch($type){
			case "create":
			break;
		}

		return $this;
	}
	// */

	public function getLegitimateUser() {
		$user = $this->getUser();

		if(!$user){
			throw new \Exception("User ghoib! please specify user using \$this->setUser();");
		}

		return $user;
	}

	/**
	 * Get the value of user
	 */ 
	public function getUser() {
		return $this->user;
	}

	/**
	 * Set the value of user
	 *
	 * @return  self
	 */ 
	public function setUser($user) {
		$this->user = $user;

		return $this;
	}

	public function average($arr){
		return (double) array_sum($arr) / sizeof($arr);
	}

	/**
	 * Get the value of code
	 */ 
	public function getCode() {
		return $this->code;
	}

	/**
	 * Set the value of code
	 *
	 * @return  self
	 */ 
	public function setCode($code) {
		$this->code = $code;

		return $this;
	}
}
