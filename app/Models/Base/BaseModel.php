<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BaseModel extends Model {
	function reconnectAndNoStrict(){
		DB::disconnect('mysql');
		config()->set('database.connections.mysql.strict', false);
		DB::reconnect('mysql');
	}
}