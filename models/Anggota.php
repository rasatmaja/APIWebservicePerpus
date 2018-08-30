<?php
    namespace models;
    use lib\Core;
    use PDO;

    class Anggota{
        protected $core;

        function __construct(){
            $this->core = Core::getInstance();
        }

        public function aktivasiAnggotaOnline($data){
            $sql = "CALL AktivasiAnggota(?, ?, ?, @status)";

            $stmt = $this->core->dbh->prepare($sql);
            $stmt->bindParam(1, $data["nim"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 20);
            $stmt->bindParam(2, $data["password"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 225);
            $stmt->bindParam(3, $data["email"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 50);
            $stmt->execute();
            $stmt->closeCursor();
 
            $row = $this->core->dbh->query("SELECT @status AS status")->fetch(PDO::FETCH_ASSOC);
            return $row['status'];
        }
    }
?>