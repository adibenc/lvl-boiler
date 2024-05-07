<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Repositories\LayananRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LayananRepository $lrepo)
    {
        $this->layanan = $lrepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('public.home');
    }

    public function board($alias = null)
    {
        $withAntrian = $withAntrian = $this->layanan->withTodayAntrianByAlias($alias);
        
        if(empty($withAntrian) || sizeof($withAntrian) < 1){
            // return abort(404);
        }
        
        return view('public.antrian-board', compact('withAntrian'));
    }

    public function generate(){
        $ret = $this->layanan->generateAntrian(['id' => 7]);

        return response()->json($ret);
    }
}
