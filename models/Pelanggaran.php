<?php
    namespace models;
    use lib\Core;
    use PDO;

    class Pelanggaran {
        protected $core;

        function __construct(){
            $this->core = Core::getInstance();
        }

        public function semuaPelanggaran($nim){
            $sql = "CALL SemuaDataPelanggaran('$nim')";
            
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);		   	
            } else {
                $data = 0;
            }		
            return $data;
            
        }

        public function pelanggaranBelumSelesai($nim){
            $sql = "CALL DataPelanggaranBelumSelesai('$nim')";

            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);		   	
            } else {
                $data = 0;
            }		
            return $data;
        }

        public function pelanggaranSudahSelesai($nim){
            $sql = "CALL DataPelanggaranSudahSelesai('$nim')";
            
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);		   	
            } else {
                $data = 0;
            }		
            return $data;
        }

    }
?>