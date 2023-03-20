<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Session;
use DB;

class c_Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

      $this->middleware(function ($request, $next){
        
        if(!Session::get('login_sistem')){
          return redirect('/');
        }else{
          return $next($request);
        }
        
      });
    }

    public function checkin(){

        $pendaftar = DB::select("SELECT * FROM pendaftaran");

        return view('/admin/checkin', ['pendaftar' => $pendaftar]);
    }

    public function checkin_update($id){

      DB::table('pendaftaran')->where('kode_ID', $id)->update([
        'status_checkin'  => "Sudah"
      ]);

      return redirect()->back();
    }

    public function checkin_id($id){

      $pendaftar = DB::select("SELECT * FROM pendaftaran WHERE kode_ID='$id'");

      return view('/admin/checkin_id', ['pendaftar' => $pendaftar]);
    }
    
    public function checkin_ubah(Request $req){

      $id = $req->id;

      DB::table('pendaftaran')->where('kode_ID', $id)->update([
        'pendaftaran_nama'         => $req->nama_pendaftar,
        'pendaftaran_no_telp'      => $req->no_telp,
        'pendaftaran_jenis_tiket'  => $req->jenis_tiket,
        'pendaftaran_jumlah_bayar' => $req->jumlah_bayar,
        'status_checkin'           => $req->status_checkin
      ]);
      
      return redirect()->back();
    }

    public function checkin_hapus($id){

      DB::table('pendaftaran')->where('kode_ID', $id)->delete();

      return redirect("/checkin");
    }

    
    
}
