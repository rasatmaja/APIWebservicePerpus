<?php
    namespace controller;

    class AnggotaController{

        public function aktivasi($request, $response, $args){
            $dataLogin = $request->getParsedBody();
            $anggota = new \models\Anggota();

            $BaisLogin = 'https://bais.ub.ac.id/api/login/jsonapi/?userid=<<userid>>&passport=<<passport>>&challenge=<<challenge>>&appid=SIPUS&ipaddr=<<localid>>';
            $gen = new AnggotaController();

            $chal = $gen->genRandomString();
            $url = str_replace('<<userid>>', urlencode($dataLogin['nim']), $BaisLogin);
            $url = str_replace('<<challenge>>', urlencode($chal), $url);
            $url = str_replace('<<localid>>', urlencode($_SERVER['REMOTE_ADDR']), $url);
            $url = str_replace('<<passport>>', urlencode(md5($chal.$dataLogin['password']).'_'.$dataLogin['nim']), $url);

            $obj = json_decode(file_get_contents($url), true);

            if ($obj['error'] == "0"){
                if($anggota->aktivasiAnggotaOnline($dataLogin)==01){
                    return $response->withJson(["status" => "success", "pesan" => "Aktivasi berhasil"]);
                } else if ($anggota->aktivasiAnggotaOnline($dataLogin)==02){
                    return $response->withJson(["status" => "success", "pesan" => "Akun sudah terdaftar"]);
                }
                return $response->withJson(["status" => "failed", "pesan" => "Aktivasi gagal"]);
            } elseif ($obj['error'] == "01") {
                return $response->withJson(["status" => "failed", "pesan" => "Data tidak terdaftar"]);
            } elseif ($obj['error'] == "02") {
                return $response->withJson(["status" => "failed", "pesan" => "Password salah"]);
            } 
        }

        public function genRandomString() {
            $length = 5;
            $characters ='0123456789abcdefghijklmnopqrstuvwxyz';
            $string = "";    
    
            for ($p = 0; $p < $length; $p++) {
                $string .= $characters[mt_rand(0, strlen($characters))];
            }
            return $string;
        }
    }
?>