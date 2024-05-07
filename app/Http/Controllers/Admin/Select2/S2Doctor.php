<?php

namespace App\Http\Controllers\Admin\Select2;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class S2Doctor extends Select2Base {
	function __construct() {
	}

	public function setupBuilder($q) {
		$b = (new User)
			->with([
				"profile:id,user_id,birth_at"
			])
			->orWhere('username', 'LIKE', "%$q%")
			->orWhere('name', 'LIKE', "%$q%")
			->orWhere('email', 'LIKE', "%$q%")
			->orWhere('username', 'LIKE', "%$q%")
			->where("role", "doctor")
			->get(['id', 'name']);

		return $b;
	}
}
