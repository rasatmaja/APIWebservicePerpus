<?php
    namespace models;
    require './vendor/autoload.php';

    use lib\Core;
    use PDO;
    use Ramsey\Uuid\Uuid;
    use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

    class ApiKey {
        protected $core;

        function __construct(){
            $this->core = Core::getInstance();
        }

        public function ip($api_key){
            $sql = "SELECT ip_address as ip FROM akses_api
                    WHERE api_key = '$api_key'";
            
            $stmt = $this->core->dbh->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }

        public function get_ip_UB(){
            $sql = "SELECT ip_address FROM akses_api
                    WHERE nama = 'UB'";
            
            $stmt = $this->core->dbh->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }

        public function cekValidasiAPI($api_key){
            $sql = "SELECT api_key FROM akses_api
                    WHERE api_key = '$api_key'";
            
            $stmt = $this->core->dbh->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);

            if(count($data) > 0){
                return true;
            } else {
                return false;
            }	   			
            
        }

        public function  get_api_data(){
            $sql = "SELECT * FROM akses_api
                    GROUP BY api_key";
            
            $stmt = $this->core->dbh->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }

        function update_api_data($data){
            $id           = $data['id'];
            $column_name  = $data['column_name'];
            $text         = $data['text'];

            $sql = "UPDATE akses_api SET $column_name='$text' WHERE id = '$id'";
            $stmt = $this->core->dbh->prepare($sql);
            $hasil = $stmt->execute();
            return $hasil;
        }

        function delete_api_data($data){
            $id = $data['api_key'];

            $sql = "DELETE FROM akses_api WHERE api_key = '$id'";
            $stmt = $this->core->dbh->prepare($sql);
            $hasil = $stmt->execute();
        }

        function create_api_data($data){
            $sql=null;
            $nama = $data['namaunitkerja'];
            $awal_ip = $data['ipaddress1'];
            $akhir_ip = $data['ipaddress2'];
            
            $uuid4 = Uuid::uuid4();
            $key = $uuid4->toString();

            if(empty($akhir_ip)){
                $sql = "INSERT INTO akses_api(api_key, ip_address, nama) VALUES ('$key', '$awal_ip', '$nama');";
                $stmt = $this->core->dbh->prepare($sql);
                $stmt->execute();
            }else{
                $api = new ApiKey();
                $range_ip_address = $api->ip_range($awal_ip, $akhir_ip);
                
                foreach($range_ip_address as $ip){
                    $sql .= "INSERT INTO akses_api(api_key, ip_address, nama) VALUES ('$key', '$ip', '$nama');"."\n";  
                };

                $stmt = $this->core->dbh->prepare($sql);
                $hasil = $stmt->execute();
            }

        }

        function ip_range($start, $end) {
            $start = ip2long($start);
            $end = ip2long($end);
            return array_map('long2ip', range($start, $end) );
        }

        function adminData($username, $password){
            $sql = "SELECT * FROM pengguna
                    WHERE username = '$username' AND password = '$password'";
            
            $stmt = $this->core->dbh->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }
    }
?>