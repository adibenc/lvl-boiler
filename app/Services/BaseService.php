<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BaseService {
    protected $cacheExpired = 300; // 6*50 = 5 minutes in seconds
    protected $mainTable = "users"; // 6*50 = 5 minutes in seconds
    protected $env = "dev";
    protected $logfname = "api-main";

    protected $BASE_URL_DEV = "http://localhost/api";
    protected $BASE_URL_PROD = "http://localhost/api";
    
    //endpoints / methods
    // *_P = *_PERKARA
    const URI_ENDPOINT = "/";

    protected $header = [];
    protected $throwIfError = true;

    public $response;
    public $httpClient;

	function __construct($client = null){
        if ( empty($client)){
            $this->setDefaultHttpClient();
        }
        
        $this->setEnv("dev");
    }

    function setDefaultHttpClient(){
        $this->setHttpClient(new Http());
        return $this;
    }

    function setEnv($env){
        $this->env = $env;
        return $this;
    }

	function getEnv(){
        return $this->env;
    }

	function getUrl($withSuffix = true){
        $env = $this->getEnv();
        $url = "";
        if($env == "prod"){
            // $url = self::BASE_URL_PROD;
            $url = $this->BASE_URL_PROD;
        }else if($env == "dev"){
            // $url = self::BASE_URL_DEV;
            $url = $this->BASE_URL_DEV;
        }
        
        return $url;
    }

	protected function post($url = "", $payload = []){
        $header = $this->getHeader();

        return Http::withHeaders($this->getHeader())
			->timeout(5)
            ->post($url, $payload);
    }

    protected function postAndDecode($url = "", $payload){
        $ret = $this->post($url, $payload);
        $d = json_decode($ret);
        $d = $d ? $d : null;
        
        if(!$d){
            $this->logs([
                $url, $payload, $d
            ]);
            if($this->throwIfError){
                throw new \Exception($ret);
            }
        }
        
        return $d;
    }

	protected function get($url = ""){
        return Http::get($url);
    }
    
    protected function getAndDecode($url = ""){
        $ret = $this->get($url);
        $d = json_decode($ret);
        $d = $d ? $d : null;
        
        // to do : logs
        if(!$d){
            $this->logs([
                $url, $d
            ]);
            if($this->throwIfError){
                throw new \Exception($ret);
            }
        }
        
        return $d;
    }

    function test(){
        $url = $this->getUrl();
        $ret = $this->get($url);

        return $ret['body'];
    }

    function decode($p){
        $ret = json_decode($p);
        if( empty($ret) ){
            throw new \Exception("Json return invalid");
        }
        return $ret;
    }
 
	public function getHeader(){
		return $this->header;
	}

	public function setHeader($header){
		$this->header = $header;

		return $this;
	}

    public function addHeader($header){
		$this->header[] = $header;

		return $this;
	}

	public function getHttpClient(){
		return $this->httpClient;
	}

	public function setHttpClient($httpClient){
		$this->httpClient = $httpClient;

		return $this;
	}

    public function setBasicAuth($user, $pass){
        $cred = base64_encode($user).":".base64_encode($pass);
        $this->addHeader("Authorization: Basic ".$cred);

        return $this;
    }

    public function setBearerAuth($cred){
        // $cred = base64_encode($user).":".base64_encode($pass);
        $this->addHeader("Authorization: Bearer ".$cred);

        return $this;
    }
    
    public function useJsonHeader(){
        $this->addHeader("Content-Type: application/json");

        return $this;
    }

    protected function logs($data){
        return Log::info($data);
    }
}
