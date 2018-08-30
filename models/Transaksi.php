<?php
    namespace models;
    use lib\Core;
    use PDO;

    class Transaksi {
        protected $core;

        function __construct(){
            $this->core = Core::getInstance();
        }

        public function semuaTransaksi($nim){
            $sql = "CALL SemuaDataTransaksi ('$nim')";
                     
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);		   	
            } else {
                $data = 0;
            }		
            return $data;
        }

        public function transaksiSudahKembali($nim){
            $sql = " CALL TransaksiSudahKembali('$nim')";
            
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);		   	
            } else {
                $data = 0;
            }		
            return $data;
        }

        public function transaksiBelumKembali($nim){
            $sql = "CALL TransaksiBelumKembali('$nim')";
            
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);		   	
            } else {
                $data = 0;
            }		
            return $data;
        }

        public function perpanjangan($data){
            
            $sql = "CALL PerpanjanganKoleksi(?, @status);"; 
            
            $stmt = $this->core->dbh->prepare($sql);
            $stmt->bindParam(1, $data["id_peminjaman_koleksi"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 20);
            $stmt->execute();
            $stmt->closeCursor();
 
            $row = $this->core->dbh->query("SELECT @status AS status")->fetch(PDO::FETCH_ASSOC);
            return $row['status'];
        }

    }
?>