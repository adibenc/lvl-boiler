<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZenvivaService extends BaseService{
	// protected $BASE_URL_DEV = "http://127.0.0.1:8001/api";
	protected $BASE_URL_DEV = "https://console.zenziva.net";
	protected $BASE_URL_PROD = "https://console.zenziva.net";

	const SMSG = "/reguler/api/sendsms/";
	const SMSGV = "/smsgateway-vip";
	const SMSGOTP = "/smsgateway-otp";
	const SMSWA = "/wareguler/api/sendWA";

	static $SMS_OTP_FMT = "send otp msg: :otp";
	static $ZENVIVA_USER;
	static $ZENVIVA_PASS;
	static $ZENVIVA_USE_PROD;

	public function __construct() {
		self::$ZENVIVA_USER = env("ZENVIVA_USER");
		self::$ZENVIVA_PASS = env("ZENVIVA_PASS");
		self::$ZENVIVA_USE_PROD = env("ZENVIVA_USE_PROD");

		$this->apikey = env('WEBSMS_API_KEY');
		$this->BASE_URL_DEV = 
			config("app.env", "local") == "local" ? 
			$this->BASE_URL_DEV : 
			$this->BASE_URL_DEV;
	}

	public function checkError($data){
		$data = (object) $data;

		if(!$data->status){
			$msg = "Non std err :: ".presonRet($data);
			Log::error($msg);
			throw new Exception($msg);
		}

		if($data->status != "1"){
			throw new Exception("err zs ".$data->text);
		}
	}

	public function send($to, $msg){
		if(!self::$ZENVIVA_USE_PROD){
			return;
		}

		// POST https://console.zenziva.net/reguler/api/sendsms/
		$pl = [
			'userkey' => self::$ZENVIVA_USER,
			'passkey' => self::$ZENVIVA_PASS,
			'to' => $to,
			'message' => $msg
		];
		$url = $this->getUrl().self::SMSG;

		$d = $this->postAndDecode($url, $pl);
		// Log::info( presonRet([$url, $d]) );
		$this->checkError($d);

		return $d;
	}

	public function sendOtp($to, $msg){
		if(!self::$ZENVIVA_USE_PROD){
			return;
		}

		// https://websms.co.id/api/smsgateway-otp?token=[token]&to=[to]&msg=[msg]
		$arr = [
			'token' => $this->apikey,
			'to' => $to, 
			'msg' => $msg
		];
		$url = $this->getUrl().self::SMSGOTP."?".http_build_query($arr);

		$d = $this->getAndDecode($url);
		// Log::info( presonRet([$url, $d]) );
		$this->checkError($d);

		return $d;
	}
	
	public function sendWA($to, $msg){
		if(!self::$ZENVIVA_USE_PROD){
			return;
		}

		// POST https://console.zenziva.net/wareguler/api/sendWA/
		$pl = [
			'userkey' => self::$ZENVIVA_USER,
			'passkey' => self::$ZENVIVA_PASS,
			'to' => $to,
			'message' => $msg
		];
		$url = $this->getUrl().self::SMSWA;

		Log::info($url);
		Log::info(presonRet($pl));

		$d = $this->postAndDecode($url, $pl);
		// Log::info( presonRet([$url, $d]) );
		$this->checkError($d);

		return $d;
	}
}