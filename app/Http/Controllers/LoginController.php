<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class LoginController extends Controller
{
    public function admin(){
        return view('/login');
    }
    public function login(Request $req){
        $user = htmlspecialchars($req->input('username'));
        $pass = htmlspecialchars($req->input('password'));

        $query = DB::select("SELECT * FROM user WHERE username='$user' and password='$pass'");
        $count = count($query);

        if($count > 0){
            foreach($query as $data){
                if($data->user_level == "Admin"){
                    $req->session()->put('id', $data->user_id);
                    $req->session()->put('user_nama', $data->user_nama);
                    $req->session()->put('username', $data->username);
                    $req->session()->put('password', $data->password);
                    $req->session()->put('user_level', $data->user_level);

                    $req->session()->put('login_sistem', true);
                    $req->session()->put('login_admin!@', true);
                    $req->session()->put('login_anggotaa1', true);

                    return redirect('/checkin');
                }
            }
        }else{
            return redirect('/admin')->with(['error' => 'Username/Password Salah!']);
        }
    }

    public function logout(){

        Session::flush();
        return redirect('/admin')->with(['logout' => 'logout']);
    }
}
