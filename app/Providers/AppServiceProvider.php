<?php

namespace App\Providers;

use App\Models\DtOrders;
use App\Models\Project;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		// https://laravel.com/docs/master/blade#manually-registering-components
		Blade::componentNamespace('App\\View\\Components\\Metronic', 'metronic');

		if($this->app->environment('production')) {
			URL::forceScheme('https');
		}
		
        //
		view()->composer('*', function($view) {
			/*
			$outlet = $user->outlet;
			$view->with('user', $user)
			->with('outlet', $outlet);
			*/
			$_user = auth()->user();
			
			// todo
			// $_baseurl = url("/")."/";
			$_baseurl = env("APP_URL");
			$_asset = asset('');
			$_uploaddir = asset('storage/uploads');

			$arr = [
				'_user',
				'_baseurl',
				'_asset',
				'_uploaddir',
			];

			if($_user){
				$isSuperadmin = $_user->role === "superadmin";
				$isDoctor = $_user->role === "doctor";
				$isAdmin = $_user->role === "admin";

				array_push($arr,
					'isSuperadmin',
					'isDoctor',
					'isAdmin',
				);

				if($isAdmin){
					$_mycompany = $_user->myHospital;
					array_push($arr, '_mycompany');
				}
			}
			
			foreach($arr as $e){
				$view->with($e, $$e);
			}
		});
    }
}
