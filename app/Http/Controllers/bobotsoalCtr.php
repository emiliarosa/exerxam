<?php
namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\user;
use App\Models\banksoal;
use App\Models\bobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class bobotsoalCtr extends Controller{
	public function bobotsoal (){
	$get_kategori=Session::get('kategori');
	$result = banksoal::where('mapel',$get_kategori)->get();
	return view('bobotsoal', ['result'=>$result]);
	}
	public function hapussoalPost(Request $request){
		//$id_guru=$request->id_guru; -> id_guru dapatnya dari atribut input name form
		$id=$request->id;
		banksoal::destroy($id);
		return redirect('/bobotsoal')->with('alert','user berhasil di hapus');
	}
	public function tambahbobotPost(Request $request){
		$this->validate($request, [
			'bobot' => 'required'
		]);
		$req_bobot = $request->bobot;
		$req_id_guru = $request->id_guru;
		$req_id_soal = $request->id_soal;
		if ($req_bobot <= 10){
			$cek = bobot::where('id_soal', '=', $req_id_soal)->where('id_guru', '=', $req_id_guru)->get()->count();
			if ($cek==0) {
				bobot::create([
					'bobot' => "$req_bobot",
					'id_guru' => "$req_id_guru",
					'id_soal' => "$req_id_soal"
			]);
			}
			else{
				bobot::where('id_soal', '=', $req_id_soal)->where('id_guru', '=', $req_id_guru)->update([
					'bobot' => "$req_bobot",
					'id_guru' => "$req_id_guru",
					'id_soal' => "$req_id_soal"
				]);
			}
				$getbobot = bobot::where('id_soal', '=', $req_id_soal)->get();
				$hitungbobot=0;
					foreach($getbobot as $data){
						$nilaibobot=$data->bobot;
						$hitungbobot=$hitungbobot+$nilaibobot;
					}
						$cekdata = $getbobot->count();
						$finalbobot = $hitungbobot/$cekdata;
						banksoal::where('id', '=', $req_id_soal)->update([
							'bobot' => "$finalbobot"
						]);
		}
			return redirect()->back()->with('succes','kelas berhasil ditambah');
	}
}