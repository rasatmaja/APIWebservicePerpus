<?php
    namespace controller;
    class PelanggaranController {
        private $cache;

        public function __construct($container){
            $this->cache = $container->get('cache');
        }

        public function __invoke($request, $response, $args) {
            $nim = $args['nim']; 
            $pelanggaran = new \models\Pelanggaran();
            $dataPelanggaran = $pelanggaran->semuaPelanggaran($nim);
            
            $response = $this->cache->withExpires($response->withJson($dataPelanggaran), time() + 3600);
            return $response;
        }

        public function belumSelesai ($request, $response, $args) {
            $nim = $args['nim']; 
            $pelanggaran = new \models\Pelanggaran();
            $dataPelanggaran = $pelanggaran->pelanggaranBelumSelesai($nim);
            
            $response = $this->cache->withExpires($response->withJson($dataPelanggaran), time() + 3600);
            return $response;
        }
        
        public function sudahSelesai ($request, $response, $args) {
            $nim = $args['nim']; 
            $pelanggaran = new \models\Pelanggaran();
            $dataPelanggaran = $pelanggaran->pelanggaranSudahSelesai($nim);
            
            $response = $this->cache->withExpires($response->withJson($dataPelanggaran), time() + 3600);
            return $response;
        }
    }
?>