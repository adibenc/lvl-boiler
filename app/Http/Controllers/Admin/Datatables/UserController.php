<?php

namespace App\Http\Controllers\Admin\Datatables;

use App\Http\Controllers\Admin\Datatables\DTControllerBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

class UserController extends DTControllerBase
{
    protected $model = User::class;

	public function __construct(){
        $this->middleware('auth');
        $this->middleware('roles:superadmin');
    }
}
