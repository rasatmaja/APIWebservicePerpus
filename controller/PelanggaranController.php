<?php
    namespace controller;
    class PelanggaranController {
        public function __invoke($request, $response, $args) {
            $nim = $args['nim']; 
            $pelanggaran = new \models\Pelanggaran();
            $dataPelanggaran = $pelanggaran->semuaPelanggaran($nim);
            
            return $response->withJson($dataPelanggaran);
        }

        public function belumSelesai ($request, $response, $args) {
            $nim = $args['nim']; 
            $pelanggaran = new \models\Pelanggaran();
            $dataPelanggaran = $pelanggaran->pelanggaranBelumSelesai($nim);
            return $response->withJson($dataPelanggaran);;
        }
        
        public function sudahSelesai ($request, $response, $args) {
            $nim = $args['nim']; 
            $pelanggaran = new \models\Pelanggaran();
            $dataPelanggaran = $pelanggaran->pelanggaranSudahSelesai($nim);
            return $response->withJson($dataPelanggaran);
        }
    }
?>