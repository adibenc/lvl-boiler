<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Traits\CRUDRepoTrait;
use App\Models\Tickets;
use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\Traits\ExImportTraitRep;
use DB;
use Arr;
use Carbon\Carbon;
use Hash;

use App\Imports\UsersImport;

class UserRepository extends BaseRepository
{
	use CRUDRepoTrait;
	use ExImportTraitRep;
	
	protected $mainTable = "users";

	public function __construct()
	{
		$this->setModel(User::class);
	}

	public function insertData($attr){
		$this->logsEvent($attr);

		$role = Arr::get($attr, "role");
		$role = in_array($role, ["member", "doctor"]) ? $role : "member";
		$isMember = $role == "member";
		
		$weight = 0;
		$height = 0;

		if($isMember){
			$weight = $attr['weight'];
			$height = $attr['height'];
		}

		$dob = $attr['dob'];

		$bsa = User::calcBSA($weight, $height);
		$birthDate = Carbon::parse($dob);
		$today = Carbon::now();
		$age = $today->diffInYears($birthDate);
		$bmi = UserProfile::calcBMI($weight, $height);

		$passwd = bcrypt($attr['password']);
		$phone = $attr['phone'];
		$phone = User::changePhonePrefix($phone);

		$d = [
			'name' => $attr['name'],
			'phone' => $phone,
			'address' => $attr['address'],
			'weight' => $weight,
			'height' => $height,
			'birth_at' => $dob,
			'age' => $age,
			'bsa' => $bsa, // todo auto
			'bmi' => $bmi,
			
			'is_active' => 1, 
			'role' => $role, 
			'email' => $attr['email'],
			'username' => $attr['username'],
			'password' => $passwd,
			'email_verified_at' => now(), 
		];
		
		return $d;
	}

	public function updateData($attr){
		$role = Arr::get($attr, "role");
		$role = in_array($role, ["member", "doctor"]) ? $role : "member";
		$isMember = $role == "member";
		
		$weight = 0;
		$height = 0;

		if($isMember){
			$weight = $attr['weight'];
			$height = $attr['height'];
		}

		$dob = $attr['dob'];

		$bsa = User::calcBSA($weight, $height);
		$birthDate = Carbon::parse($dob);
		$today = Carbon::now();
		$age = $today->diffInYears($birthDate);
		$bmi = UserProfile::calcBMI($weight, $height);

		$phone = $attr['phone'];
		$phone = User::changePhonePrefix($phone);

		$data = [
			'name' => $attr['name'],
			'address' => $attr['address'],
			'phone' => $phone,
			'weight' => $weight,
			'height' => $height,
			'birth_at' => $attr['dob'],
			'age' => $age,
			'bsa' => $bsa,
			'bmi' => $bmi,
			
			// 'is_active' => 1, 
			// 'role' => "member", 
			'email' => $attr['email'],
			'username' => $attr['username'],
		];
		
		if(! empty(Arr::get($attr, 'email_verified_at'))){
			$data['email_verified_at'] = now();
		}

		if(!empty($attr['password']) && !empty($attr['repassword'])){
			$data['password'] = bcrypt($attr['password']);
		}
		$this->logsEvent($attr);
		
		return $data;
	}

	public function validate($type, $data){
		switch($type){
			case "create":
			case "update":
				$this->baseValidate($data, [
					"phone" => 'required',
				]);
			break;
		}

		return $this;
	}

	public function store($attr) {
		try{
			DB::beginTransaction();
			$attr = $this->insertData($attr);
			$data = $this->model::create($attr);
	
			$data->profile()->create([
				'phone' => $attr['phone'],
				'address' => $attr['address'],
				'weight' => $attr['weight'],
				'height' => $attr['height'],
				'birth_at' => $attr['birth_at'],
				'age' => $attr['age'],
				'bsa' => $attr['bsa'], // todo auto
			]);
			DB::commit();
			$this->onCreated($data);
		}catch(\Exception $e){
			DB::rollback();
			throw $e;
		}
		
		return $data;
	}

	public function update($request, $id) {
		$dbData = $this->model::find($id);

		if (empty($dbData)) {
			throw new \Exception($this->model." not found");
		}

		DB::beginTransaction();
		try {
			// $attr = $request->all();
			$attr = $this->updateData($request->all());
			$update = $this->doUpdate($dbData, $attr);

			// $dbData->profile()->update([
			$dbData->profile()->updateOrCreate(
				["user_id" => $dbData->id ],
				[
				"user_id" => $dbData->id,
				'address' => $attr['address'],
				'weight' => $attr['weight'],
				'height' => $attr['height'],
				'birth_at' => $attr['birth_at'],
				'phone' => $attr['phone'],
				'age' => $attr['age'],
				'bsa' => $attr['bsa'], // todo auto
			]);
			
			DB::commit();
			$this->onUpdated($dbData);
			
			return $dbData;
		} catch (\Exception $th) {
			DB::rollback();
			throw $th;
		}
	}
	public function allowDelete($data)
	{
		$c = !in_array($data->username, User::BLACKLIST_DELETE);
		return $c;
	}

	public function getAllAgents()
	{
		$d = $this->getMainDB()->select('*')->whereIn("role", User::AGENT_BY_ROLES)->get();

		return $d;
	}

	public function login($usernameField, $attributes)
	{
		$user = User::where($usernameField, $attributes[$usernameField])->first();
		// dd($user);
		if (!$user) {
			throw new \Exception("No user found! Plz check again");
		}

		if (!Hash::check($attributes['password'], $user->password)) {
			throw new \Exception("Wrong username / password");
		}

		// create token
		// $token = $user->createToken(env("TOKEN_SECRET"))->accessToken;
		$token = $user->createToken(env("TOKEN_SECRET"))->plainTextToken;

		return [
			'access_token' => $token,
			'user' => $user
		];
	}

	public function show($id)
	{
		$data = $this->model::find($id);
		$data->profile;

		if (empty($data)) {
			throw new \Exception((string)$this->model . " not found");
		}
		return $data;
	}

	public function getImportClass() {
		return UsersImport::class;
	}
}
