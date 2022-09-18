<?php
namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class guruCtr extends Controller{
	public function view (){
		$viewdataguru = DB::table('gurus')
		->join('users','users.id_guru','=','gurus.id')
		->select('*')
		->get();
		return view('dataguru', ['dataguru'=>$viewdataguru]);//dataguru : halamannya=>di blade berarti @dataguru
	}//dataguru : blade (2)dataguru : variabel -? $dataguru
	//join uuntuk 1 to 1

	public function tambahnipguruPost(Request $request){
		$this->validate($request, [
			'nip_guru' => 'required|min:5|unique:gurus'
		]);
		$req_nip_guru = $request->nip_guru;
		guru::create([
			'nip_guru' => "$req_nip_guru"
		]);
		$ambilidguru = guru::where('nip_guru', '=', $req_nip_guru)->first();
		user::create([//insert
			'id_guru' => $ambilidguru->id, //id_guru : kolom di tabel. id : kolom
			'id_siswa' => '0'
		]);
		$ambiliduser = user::where('id_guru', '=', $ambilidguru->id)->first();
		guru::find($ambilidguru->id)->update([
			'id_users' => $ambiliduser->id
		]);
		return redirect()->back()->with('succes','guru berhasil ditambah');
	}
	public function editguruPost(Request $request){
		$this->validate($request, [
			'nip_guru' => 'required|min:5',
			'nama_guru' => 'required',
			'kategoriguru' => 'required',
			'username' => 'required'
		]);
		$req_id_guru = $request->id_guru;
		$req_id_users = $request->id_users;
		$req_nip_guru = $request->nip_guru;
		$req_nama_guru = $request->nama_guru;
		$req_kategori_guru = $request->kategoriguru;
		$req_username = $request->username;
		guru::find($req_id_guru)->update([
			'nip_guru' => "$req_nip_guru",
			'nama_guru' => "$req_nama_guru",
			'kategori_guru' => "$req_kategori_guru"
		]);
		user::find($req_id_users)->update([
			'username' => "$req_username"
		]);
		return redirect()->back()->with('succes','guru berhasil ditambah');
	}
	public function hapusguruPost(Request $request){
		//$id_guru=$request->id_guru; -> id_guru dapatnya dari atribut input name form
		$req_id_guru = $request->id_guru;
		$req_id_users = $request->id_users;
		guru::destroy($req_id_guru);
		user::destroy($req_id_users);
		return redirect()->back()->with('succes','guru berhasil dihapus');	
	}
	public function passwordguruPost(Request $request){
		$this->validate($request, [
			'passbaru' => 'required'
		]);
		$req_passbaru = Hash::make($request->passbaru);
		$req_id_guru = $request->id_guru;
		$req_id_users = $request->id_users;
		user::find($req_id_users)->update([
			'password' => "$req_passbaru"
		]);
		return redirect()->back()->with('succes','guru berhasil ditambah');
	}
}