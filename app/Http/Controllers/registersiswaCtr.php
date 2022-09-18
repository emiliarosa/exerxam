<?php
namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class registersiswaCtr extends Controller{
	public function registersiswa (){
		return view('registersiswa');
	}
	public function registersiswaPost(Request $request){
		$this->validate($request, [
			'namasiswa' => 'required|min:5',
			'nisn' => 'required|min:5',
			'kelas' => 'required',
			'username' => 'required|min:5|unique:users',
			'password' => 'required',
			'konfirmpassword' => 'required|same:password'
		
		]);
		$req_nisn = $request->nisn;
		$viewdatasiswa = DB::table('users')
		->join('siswas','users.id_siswa','=','siswas.id')
		->select('*')
		->where ('siswas.nisn','=', $req_nisn)
		->get();
		if (!$viewdatasiswa->isEmpty()){ 
			foreach ($viewdatasiswa as $data) {
		$req_id_siswa = $data->id_siswa;
		$req_id_users = $data->id_users;
		$datausername = $data->username;
	}
	if ($datausername==null){
		$req_namasiswa = $request->namasiswa;
		$req_kelas = $request->kelas;
		$req_username = $request->username;
		$req_password = Hash::make($request->password);
		siswa::find($req_id_siswa)->update([
			'nisn' => "$req_nisn",
			'nama_siswa' => "$req_namasiswa",
			'kelas' => "$req_kelas"
		]);
		user::find($req_id_users)->update([
			'username' => "$req_username",
			'password' => "$req_password"
		]);
		return redirect('registersiswa')->with('succes','register siswa berhasil');
	} else {
		return redirect('register')->with('failed','nisn siswa sudah terdaftar');
		}
		
	} else {
		return redirect('register')->with('failed','register sisw gagal, nisn salah, nisn belum terdaftar');
	}
}

}