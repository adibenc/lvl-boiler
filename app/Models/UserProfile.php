<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';
	
	protected $fillable = [
		'user_id',
		'phone',
		'address',
		'weight',
		'height',
		'birth_at',
		'age',
		'bsa',
		'bmi',
	];

	// protected $appends = ["bmi"];

    public function user(){
        return $this->belongsTo(User::class);
    }

	static function calcBMI($weight, $height){
		if($height <= 0){
			return 0;
		}
        return $weight / ($height/100)**2;
    }

	public function getBmiAttribute(){
        return self::calcBMI($this->weight, $this->height);
    }
}
