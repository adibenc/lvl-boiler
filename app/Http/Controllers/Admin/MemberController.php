<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Repositories\MemberRepository;
use Illuminate\Http\Request;

class MemberController extends JsonCrudController
{
	protected $blades = [
		"index" => "admin.user.index",
		"add" => "admin.user.add",
		"edit" => "admin.user.edit",
	];
	
	public function __construct(
		MemberRepository $dataRepository
	) {
		$this->dataRepository = $dataRepository;
		$this->middleware("roles:superadmin|admin");
	}

	public function detail($id){
		try {
			$user = auth()->user();
			$roles = User::ROLES;

			return view("admin.proto-session.member-detail", 
				compact('roles'));
		} catch (\Exception $th) {
			return $th->getMessage();
			// return redirect()->route('admin.data.index')->with('error', $th->getMessage());
		}
	}
}
