<?php

namespace App\Http\Controllers\Admin\Select2;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class S2User extends Select2Base {
	function __construct() {
	}

	public function setupBuilder($q) {
		$b = (new User)
			->where('name', 'LIKE', "%$q%")
			->where('email', 'LIKE', "%$q%")
			->where('username', 'LIKE', "%$q%")
			->get(['id', 'name']);

		return $b;
	}
}
