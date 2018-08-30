<?php
    namespace controller;

    class BukuController{
        /**
         * function pengusulanBuku digunakan untuk mengajukan penusulan buku
         * 
         */
        public function pengusulanBuku($request, $response, $args){
            $dataBuku = $request->getParsedBody();
            $buku = new \models\Buku();
            if($buku->pengusulan($dataBuku)==true){
                return $response->withJson(["status" => "success", "pesan" => "Pengususlan Buku Berhasil"], 200);               
            }
            return $response->withJson(["status" => "failed", "pesan" => "Pengusulan Buku Gagal"], 200);
        }
    }
?>