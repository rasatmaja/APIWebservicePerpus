<?php
    namespace models;
    use lib\Core;
    use PDO;
    class Buku {
        protected $core;
        function __construct(){
            $this->core = Core::getInstance();
        }
        
        public function pengusulan($data){
            $sql = "CALL PengusulanKoleksi(?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->core->dbh->prepare($sql);
            $stmt->bindParam(1, $data["no_anggota"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 20);
            $stmt->bindParam(2, $data["judul"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 225);
            $stmt->bindParam(3, $data["pengarang"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 50);
            $stmt->bindParam(4, $data["penerbit"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 50);
            $stmt->bindParam(5, $data["kota_terbit"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 25);
            $stmt->bindParam(6, $data["tahun_terbit"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 5);
            $stmt->bindParam(7, $data["keterangan"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 225);
         
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>