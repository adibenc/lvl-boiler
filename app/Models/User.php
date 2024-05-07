<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'email_verified_at',
        'role',
        'is_active',
        'password',
		'by_user',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ROLES = [
        "superadmin", "user"
    ];
    
    const AGENT_BY_ROLES = [
        "superadmin", "user"
    ];

    const BLACKLIST_DELETE = [
        "superadmin"
    ];

	const DEFAULT_200200 = "https://dummyimage.com/200x200/555/fff";

	static function boot() {
		parent::boot();

		// Registering an event listener
		static::creating(function ($model) {
			$user = auth()->user();
			$model->by_id = $user ? $user->id : null;
		});
	}

    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

    public function withProfile(){
        $this->profile;
        
        return $this;
    }

    public function unresolvedTickets(){
        $this->tickets;
        return $this;
    }
    
    function isSuperadmin(){
        return $this->role === "superadmin";
    }

	function isDoctor(){
        return $this->role === "doctor";
    }

	function byRole($r){
		return $this->where("role", $r);
	}
	
	static function calcBSA($heightInCm, $weightInKg){
		$v = sqrt(($heightInCm * $weightInKg) / 3600);
		return $v;
	}
	
	static function defaultPassword(){
		// return bcrypt("password");
		return '$2y$10$Uo/ryJyMxt4jpLItwM9lL.yEKZbuy4qXAIL0N1XerOfoDlp55Vccu';
	}

	static function changePhonePrefix($phonenum, $to = "62"){
        $ret = $phonenum;
        $id = strpos($phonenum, $to);
        if($id == 0){
            return $phonenum;
        }
        $correctPrefix = strpos($phonenum, "08") == 0;
        if(!$correctPrefix ){
            throw new \Exception("phone not begin with 08");
        }
        $offset = 1;
        $subst = substr($phonenum, $offset, strlen($phonenum)-$offset);
        $ret = $to.$subst;
        return $ret;
    }
}
