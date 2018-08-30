<?php
namespace controller;
class TransaksiController{
    public function __invoke($request, $response, $args) {
        $nim = $args['nim']; 
        $trasnsaksi = new \models\Transaksi();
        $dataTrasnsaksi = $trasnsaksi->semuaTransaksi($nim);
        return $response->withJson($dataTrasnsaksi);
    }

    public function sudahKembali($request, $response, $args){
        $nim = $args['nim']; 
        $trasnsaksi = new \models\Transaksi();
        $dataTrasnsaksi = $trasnsaksi->transaksiSudahKembali($nim);
        return $response->withJson($dataTrasnsaksi);
    }

    public function belumKembali($request, $response, $args){
        $nim = $args['nim']; 
        $trasnsaksi = new \models\Transaksi();
        $dataTrasnsaksi = $trasnsaksi->transaksiBelumKembali($nim);
        return $response->withJson($dataTrasnsaksi);
    }

    public function perpanjanganKoleksi($request, $response, $args){
        $dataPeminjaman = $request->getParsedBody();
        $transaksi = new \models\Transaksi();

        if($transaksi->perpanjangan($dataPeminjaman) == 01){
            return $response->withJson(["status" => "success", "pesan" => "Perpanjangan buku berhasil"], 200);
        }
        return $response->withJson(["status" => "failed", "pesan" => "Maksimal perpanjangan hanya boleh satu kali"], 200);  
    }
}
?>