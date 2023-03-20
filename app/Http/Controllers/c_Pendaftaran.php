<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
use Session;

use PDF;


class c_Pendaftaran extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pendaftaran(Request $req){

      $pesan =[
        'required' => 'Data tidak boleh kosong',
      ];

      $this->validate($req, [
        'nama_pendaftar' => 'required|max:50',
        'no_telp' => 'required|numeric',
        'jumlah_tiket'=> 'required|numeric'
      ], $pesan);
        
      $milliseconds = round(microtime(true) * 1000);
      $id           = "PEN_".date('dmY_His').$milliseconds;
      $jenis = str_replace(" ","", $req->jenis_tiket);
      $kode_ID      = $jenis."".round(microtime(true));

      if($req->jenis_tiket == "VVIP"){
        $harga = 500000;
      }elseif($req->jenis_tiket == "VIP A"){
        $harga = 350000;
      }elseif($req->jenis_tiket == "VIP B"){
        $harga = 300000;
      }elseif($req->jenis_tiket == "LEFPOS 1"){
        $harga = 200000;
      }elseif($req->jenis_tiket == "LEFPOS 2"){
        $harga = 100000;
      }elseif($req->jenis_tiket == "RIGPOS 1"){
        $harga = 200000;
      }elseif($req->jenis_tiket == "RIGPPOS 2"){
        $harga = 100000;
      }

      $bayar = $harga * $req->jumlah_tiket;

      DB::table('pendaftaran')->insert([
        'pendaftaran_id'           => $id,
        'pendaftaran_nama'         => $req->nama_pendaftar,
        'pendaftaran_no_telp'      => $req->no_telp,
        'pendaftaran_jenis_tiket'  => $req->jenis_tiket,
        'pendaftaran_jumlah_bayar' => $bayar,
        'kode_ID'                  => $kode_ID
      ]);

      Session::flash('sukses', 'Pendaftaran [ '.$req->nama_pendaftar.' ]');
      return redirect("/pendaftaran/".$id);
    }

    public function pendaftaran_id($id){

      $pendaftar = DB::select("SELECT * FROM pendaftaran WHERE pendaftaran_id='$id'");

      return view('/pendaftar_id', ['pendaftar' => $pendaftar]);
    }

    public function pendaftaran_cetak($id){

      $pendaftar = DB::select("SELECT * FROM pendaftaran WHERE kode_ID='$id'");

      $pdf = PDF::loadview('/pendaftar_cetak', ['pendaftar'=>$pendaftar]);
      $pdf->setPaper('A5', 'portrait');

      return $pdf->stream('Kode Tiket.pdf');
    }
    

    
}
