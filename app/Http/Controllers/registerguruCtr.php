<?php
namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class registerguruCtr extends Controller{
	public function registerguru (){
		return view('register');
	}
	public function registerguruPost(Request $request){//request ngambuil data
		$this->validate($request, [
			'namaguru' => 'required|min:5',
			'nip' => 'required|min:5',
			'kategoriguru' => 'required',
			'username' => 'required|min:5|unique:users',
			'password' => 'required',
			'konfirmpassword' => 'required|same:password'
		]);
		$req_nip = $request->nip;
		$viewdataguru = DB::table('users')
		->join('gurus','users.id_guru','=','gurus.id')
		->select('*')
		->where ('gurus.nip_guru','=', $req_nip)
		->get();
		if (!$viewdataguru->isEmpty()){ 
			foreach ($viewdataguru   as $data) {
				$req_id_guru = $data->id_guru;//id_guru = nama kolom
				$req_id_users = $data->id_users;
				$datausername = $data->username;
			}
		if ($datausername==null){
			$req_namaguru = $request->namaguru;//namaguru = nama form
			$req_kategoriguru = $request->kategoriguru;
			$req_username = $request->username;
			$req_password = Hash::make($request->password);
				guru::find($req_id_guru)->update([
					'nip_guru' => "$req_nip",
					'nama_guru' => "$req_namaguru",
					'kategori_guru' => "$req_kategoriguru"
				]);
				user::find($req_id_users)->update([
					'username' => "$req_username",
					'password' => "$req_password"
				]);
		return redirect('/')->with('succes','register guru berhasil');
	} else {
		return redirect('register')->with('failed','nip guru sudah terdaftar');
	}
		
	} else {
		return redirect('register')->with('failed','register guru gagal, nip salah, nip belum terdaftar');
	}
}

}