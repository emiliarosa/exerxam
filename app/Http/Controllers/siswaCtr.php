<?php
namespace App\Http\Controllers;
 
use App\Models\siswa;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class siswaCtr extends Controller{
	public function view (){
		$viewdatasiswa = DB::table('siswas')
		->join('users','users.id_siswa','=','siswas.id')
		->select('*')
		->get();
		return view('datasiswa', ['datasiswa'=>$viewdatasiswa]);
	}

	public function tambahnisnPost(Request $request){
		$this->validate($request, [
			'nisn' => 'required|min:5|unique:siswas'
		]);
		$req_nisn = $request->nisn;
		siswa::create([
			'nisn' => "$req_nisn"
		]);
		$ambilidsiswa = siswa::where('nisn', '=', $req_nisn)->first();
		user::create([
			'id_siswa' => $ambilidsiswa->id,
			'id_guru' => '0'
		]);
		$ambiliduser = user::where('id_siswa', '=', $ambilidsiswa->id)->first();
		siswa::find($ambilidsiswa->id)->update([
			'id_users' => $ambiliduser->id
		]);
		return redirect()->back()->with('succes','siswa berhasil ditambah');
	}
	public function editsiswaPost(Request $request){
		$this->validate($request, [
			'nisn' => 'required|min:5',
			'nama_siswa' => 'required',
			'kelas' => 'required',
			'username' => 'required'
		]);
		$req_id_siswa = $request->id_siswa;
		$req_id_users = $request->id_users;
		$req_nisn = $request->nisn;
		$req_nama_siswa = $request->nama_siswa;
		$req_kelas = $request->kelas;
		$req_username = $request->username;
		siswa::find($req_id_siswa)->update([
			'nisn' => "$req_nisn",
			'nama_siswa' => "$req_nama_siswa",
			'kelas' => "$req_kelas"
		]);
		user::find($req_id_users)->update([
			'username' => "$req_username"
		]);
		return redirect()->back()->with('succes','siswa berhasil ditambah');
	}
	public function hapussiswaPost(Request $request){
		
		$req_id_siswa = $request->id_siswa;
		$req_id_users = $request->id_users;//$id_guru=$request->id; -> id dapatnya dari atribut input name form
		siswa::destroy($req_id_siswa);
		user::destroy($req_id_users);
		return redirect()->back()->with('succes','siswa berhasil dihapus');	
	}
	public function passwordsiswaPost(Request $request){
		$this->validate($request, [
			'passbaru' => 'required'
		]);
		$req_passbaru = Hash::make($request->passbaru);
		$req_id_siswa = $request->id_siswa;
		$req_id_users = $request->id_users;
		user::find($req_id_users)->update([
			'password' => "$req_passbaru"
		]);
		return redirect()->back()->with('succes','siswa berhasil ditambah');
	}
	
}