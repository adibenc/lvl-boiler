<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Traits\CRUDRepoTrait;
use App\Models\Tickets;
use App\Models\User;
use App\Models\UserProfile;
use DB;
use Arr;
use Carbon\Carbon;
use DCarbone\PHPFHIRGenerated\R4\FHIRResource\FHIRDomainResource\FHIRPatient;
use Hash;


class MemberRepository extends UserRepository{
	// use CRUDRepoTrait;
	protected $mainTable = "users";

	public function __construct(){
		$this->setModel(User::class);
	}

	public function login($usernameField, $attributes)
	{
		$user = User::where("role", "member")
			->where($usernameField, $attributes[$usernameField])
			->first();
		
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
}