<?php
    namespace controller\middlewares;

    class MiddlewareController{
        
        /**
         * function __invoke berfungsi untuk memvalidasi "API KEY"
         * dan IP Address server
         * 
         * Ditujukan untuk penggunakan intergrasi ke SIAM dan aplikasi fakultas
         * dimana mempunyai IP  Server yang statis.
        */

        public function __invoke($request, $response, $next) {
            $key = $request->getQueryParam("key");

            if(!isset($key)){
                return $response->withJson(["status" => "API Key required"], 401);
            }
            
            $api = new \models\ApiKey();
            
            $allowed = $api->ip($key);            
            
            foreach ($allowed as $kunci => $value) {
                $ip_allowed[] = $value->ip;
            }
            
            $clientIp = $request->getAttribute('ip_address');
            
            if($api->cekValidasiAPI($key) == true && in_array($clientIp, $ip_allowed )){
                return $response = $next($request, $response);
            }
         
            return $response->withJson(["status" => "Unauthorized"], 401);
    
        }

        /**
         * function validasiHanyaApiKey berfungsi untuk memvalidasi "API KEY" saja
         * 
         * ditujukan untuk intergrasi ke aplikasi yang akan digunakan USER (Anggota Online)
         */

        public function validasiHanyaApiKey($request, $response, $next){
            $key = $request->getQueryParam("key");

            if(!isset($key)){
                return $response->withJson(["status" => "API Key required"], 401);
            }
            
            $api = new \models\ApiKey();
            
            if($api->cekValidasiAPI($key)){
                return $response = $next($request, $response);
            }
            
            return $response->withJson(["status" => "Unauthorized"], 401);
        }

        public function validasiIP($request, $response, $next){
            $clientIp = $request->getAttribute('ip_address');
            $api = new \models\ApiKey();
            
            $allowed = $api->get_ip_UB();            
            
            foreach ($allowed as $kunci => $value) {
                $allowed[] = $value->ip_address;
            }

            if(in_array($clientIp, $allowed )){
                return $response = $next($request, $response);
            }
         
            return $response->withJson(["status" => "Unauthorized"], 401);
        }
    }
?>