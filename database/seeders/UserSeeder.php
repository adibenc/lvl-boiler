<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

// php artisan db:seed --class=UserSeeder
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$json = <<<'JSON'
		[
			{
			"name": "superadmin",
			"username": "superadmin",
			"is_active": 1,
			"email": "admin@gmail.com",
			"email_verified_at": "2023-10-20T03:38:31.942099Z",
			"role": "superadmin",
			"password": "$2y$10$miASKW54gvYS3/CGP6Ce6.Nzp6OWGNMknUqwK5iSzpCGjKAOyzRHy"
			},
		]
		JSON;
		foreach(json_decode($json, true) as $i => $e){
			try{
				User::create($e);
			}catch(\Exception $e){
				preson([$i, $e->getMessage()]);
			}
		}
        //
        // User::factory()
        //     ->count(3)
        //     ->create();
    }
}
