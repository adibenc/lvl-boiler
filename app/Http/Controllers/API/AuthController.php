<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\MemberRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;
// use Laravel\Passport\Http\Controllers\AccessTokenController;

// extends passport
class AuthController extends Controller {
    public function parseB64Basic($plainAuth) {
        if(strpos($plainAuth, "Basic") !== 0){
            throw new \Exception("Invalid basic auth");
        }

        $plainAuth = str_replace("Basic ", "",$plainAuth);
        $decoded = base64_decode($plainAuth);
        $splitted = explode(":", $decoded);

        if( sizeof($splitted) != 2 ){
            throw new \Exception("Invalid basic auth");
        }

        return $splitted;
    }

    public function login(Request $request, MemberRepository $mbRepository) {
        try {
            $data = $mbRepository->login("email", [
                "email" => $request->username,
                "password" => $request->password,
            ]);

            return self::success("Ok", $data);
        } catch (\Exception $th) {
            return self::fail($th->getMessage(), null);
        }
    }

    // Kirim link ganti password dengan validasi No Hp, email dan tanggal lahir
    public function askForgotPassword(Request $request, UserRepository $userRepository) {
        try {
            $data = "forgot";

            return self::success("Ok", $data);
        } catch (\Exception $th) {
            return self::fail($th->getMessage(), null);
        }
    }

	public function resendOtp(Request $request, UserRepository $userRepository) {
		try {
			$ret = $userRepository->resendOtp($request->user());
			return self::success("Otp resend success!");
		} catch (\Exception $th) {
			return self::fail($th->getMessage(), null);
		}
	}
	
	public function resendVerifyEmail(Request $request) {
		try {
			$request->user()->sendEmailVerificationNotification();

			// to do : mask email
			return self::success('Verification link sent!');
		} catch (\Exception $th) {
			return self::fail($th->getMessage(), null);
		}
	}

	public function verifyEmailOvr() {
		try {
			$user = auth()->user();
			$muser = User::where("id", "=", $user->id)->first();

			$muser->email_verified_at = now();
			$muser->save();

			return self::success("verified!", $muser);
		} catch (\Exception $th) {
			return self::fail($th->getMessage(), null);
		}
	}

	public function getOtpOvr() {
		try {
			$id = Arr::get($_GET, "id");
			
			$muser = User::where("id", "=", $id)->get()->first();
			$otp = $muser->otp;

			$muser = $muser->toArray();
			$muser['otp'] = $otp;

			return self::success("ok", $muser);
		} catch (\Exception $th) {
			return self::fail($th->getMessage(), null);
		}
	}

	public function verifyPhone(Request $request, UserRepository $userRepository) {
		try {
			$user = auth()->user();
			if(!is_numeric($request->otp)){
				throw new \Exception("Plz input number only!");
			}

			$muser = User::where("id", "=", $user->id)->first();

			$match = $user->otp == $request->otp;
			// preson([$match, $user->otp, $request->otp]);
			// exit;

			if($match){
				$muser->otp = 0;
				$muser->otp_verified_at = Carbon::now();
				$muser->save();
			}else{
				$muser->otp_att_cnt += 1;
				$muser->save();
				throw new \Exception("Otp not match!");
			}

            return self::success("Phone verified!", $user);
        } catch (\Exception $th) {
            return self::fail($th->getMessage(), null);
        }
    }
}
