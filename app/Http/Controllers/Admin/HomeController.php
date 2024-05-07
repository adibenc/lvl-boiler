<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProtoSession;
use App\Models\ProtoSessionDetail;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware("roles:superadmin|admin");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            $user = auth()->user();
            
            return view('admin.home');
        }catch (\Exception $e) {
            return self::fail($e->getMessage(), null);
        }
    }

	public function profile() {
		return view('admin.profile');
	}

	public function getDashData() {
		try{
			$data = [];
			$ps = ProtoSession::count();
			$d1 = now()->addDay(-60);
			$d2 = now()->addDay(60);

			ProtoSessionDetail::reconnectAndNoStrict();
			$data = [
				"cnt_doctor" => sizeof((new User)->byRole("doctor")->get()),
				"cnt_member" => sizeof((new User)->byRole("member")->get()),
				"cnt_session" => $ps,
				"cnt_day_session" => ProtoSessionDetail::groupBy(["date"])
					->get("date")->count(),
				"last_session_at" => (new ProtoSessionDetail)->lastSession(),
				"next_session_at" => (new ProtoSessionDetail)->nextSession(),
				"proto_scoped" => (new ProtoSessionDetail)
					->byDateScope($d1, $d2)
					->groupBy(["date"])
					->get(),
			];
			
			return self::success("ok", $data);
		}catch (\Exception $e) {
			return self::fail($e->getMessage(), null);
		}
	}
}
