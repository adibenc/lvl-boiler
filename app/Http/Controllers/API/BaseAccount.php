<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\AntrianRepository;
use App\Repositories\LayananRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instansi;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Mail;

// replicate and manipulate data instansi
class BaseAccount extends Controller {
	 
	function __construct() {
		$this->instansi = Instansi::class;
	}

	function mx() {
		$m = Mail::send([], [], function ($message) {
				$message->to('adib35785@gmail.com')
					->subject('Welcome to Our Application')
					->setBody('Thank you for signing up!', 'text/html');
			});
	
		return compact('m');
	}

	function create(Request $req) {
		// $posts = $this->posts();
		$posts = (array) $req->all();
		
		// \Debugbar::disable();

		$wheres = [
			"ins_satkerkd" => $posts["ins_satkerkd"]
		];
		
		try{
			// handle duplicate email, username
			$existingEmail = User::where(["email" => $posts["email"]])->first();
			if($existingEmail){
				throw new \Exception("Account w/ current email exist");
			}
			

			$existingUsername = User::where(["username" => $posts["username"]])->first();
			if($existingUsername){
				throw new \Exception("Account w/ current username exist");
			}

			$existingAlias = Instansi::where(["alias" => $posts["alias"]])->first();
			if($existingAlias){
				throw new \Exception("Account w/ current alias exist");
			}

			$userData = [
				'name' => $posts["inst_nama"],
				'username' => $posts["username"],
				'email' => $posts["email"],
				'email_verified_at' => Carbon::now(),
				'password' => Hash::make($posts['plainpassword']),
				"is_active" => "1",
			];
			$user = User::create($userData);
			
			// return presonRet($user);
			// exit;

			$created = $user->instansi()->create([
				"kode" => $posts["ins_satkerkd"],
				"parent" => $posts["inst_parent"] ?? "0",
				"nama" => $posts["inst_nama"],
				"kelas" => $posts["klas"],
				"kode_laporan" => $posts["kode_laporan"],
				"alias" => $posts["alias"],
				"akses" => $posts["akses"],
				"is_active" => "1",
			]);
	
			if($created){
				return self::success("ok", [
					"instansi" => $created
				]);
			}else{
				return self::fail("instansi exist", [
					"instansi" => null
				]);
			}
			// return self::success("Ok", $data);
		}catch(\Exception $e){
        // } catch (\Exception $e) {
			return self::fail($e->getMessage(), [
				"posts" => $posts
			]);
		}
	}

	function get() {
		$gets = $this->gets();
		return self::success("ok", [
			"gets" => $gets
		]);
	}

	function update() {
		$posts = $this->posts();
		return self::success("ok", [
			"instansi" => $posts
		]);
	}

	function reset() {
		$posts = $this->posts();
		return self::success("ok", [
			"instansi" => $posts
		]);
	}
}
