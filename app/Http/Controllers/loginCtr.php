<?php
namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\siswa;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class loginCtr extends Controller{
  public function login (){
  return view('login');
 }
 public function loginPost(Request $request){
  $this->validate($request, [
   'username' => 'required|min:5',
   'password' => 'required'
  ]);
  $req_username = $request->username;
  $req_password = $request->password;
  $login = user::where('username', '=', $req_username)->first();

  if (@count($login)>0){
   if (Hash::check($req_password, $login->password)){
    $dataguru=$login->id_guru;
    $datasiswa=$login->id_siswa;
    if ($dataguru>0){
     $getdataguru = DB::table('users')
     ->join('gurus','users.id_guru','=','gurus.id')
     ->select('*')
     ->where ('users.id_guru','=', $dataguru)
     ->get();
     
     foreach ($getdataguru   as $data) {
     $id_guru = $data->id_guru;
     $id_users = $data->id_users;
     $nama_guru = $data->nama_guru;
     $kategori_guru = $data->kategori_guru;
     }
     Session::put('id_guru', $id_guru);
     Session::put('id_users', $id_users);
     Session::put('nama', $nama_guru);
     Session::put('kategori', $kategori_guru);
     Session::put('login', TRUE);
     if($kategori_guru != 'admin'){
      return redirect('buatsoal');
     }else {
      return redirect('dataguru');
     }
    }
    if ($datasiswa>0){
     $getdatasiswa = DB::table('users')
     ->join('siswas','users.id_siswa','=','siswas.id')
     ->select('*')
     ->where ('users.id_siswa','=', $datasiswa)
     ->get();

     foreach ($getdatasiswa   as $data) {
     $id_siswa = $data->id_siswa;
     $id_users = $data->id_users;
     $nama_siswa = $data->nama_siswa;
    }
     Session::put('id_siswa', $id_siswa);
     Session::put('id_users', $id_users);
     Session::put('nama', $nama_siswa);
     Session::put('kategori', 'siswa');
     Session::put('login', TRUE);
     
     return redirect('ujionsiswa');}
   }else{
    return redirect('/')->with('message', 'password salah');
   
  }}else {
   return redirect('/')->with('message', 'gagal login, username belum terdaftar');
  }
}
 public function logout(){
  Session::flush();
  return redirect('/')->with('message', 'berhasil logout');
 }
}