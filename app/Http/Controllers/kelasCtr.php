<?php
namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class kelasCtr extends Controller{
	public function view (){
		$viewkelas = kelas::all();
		return view('kelas', ['kelas'=>$viewkelas]);
	}

	public function tambahkelasPost(Request $request){
		$this->validate($request, [
			'nama_kelas' => 'required|unique:kelas',
			'kode_kelas' => 'required|unique:kelas'
		]);
		$req_nama_kelas = $request->nama_kelas;
		$req_kode_kelas = $request->kode_kelas;
		kelas::create([
			'nama_kelas' => "$req_nama_kelas",
			'kode_kelas' => "$req_kode_kelas"
		]);
		return redirect()->back()->with('succes','kelas berhasil ditambah');
	}
	public function editkelasPost(Request $request){
		$this->validate($request, [
			'nama_kelas' => 'required',
			'kode_kelas' => 'required'
		]);
		$req_nama_kelas = $request->nama_kelas;
		$req_kode_kelas = $request->kode_kelas;
		$req_id = $request->id;
		kelas::find($req_id)->update([
			'nama_kelas' => "$req_nama_kelas",
			'kode_kelas' => "$req_kode_kelas"
		]);
		return redirect()->back()->with('succes','kelas berhasil ditambah');
	}
	public function hapuskelasPost(Request $request){
		//$id_guru=$request->id; -> id dapatnya dari atribut input name form
		$req_id = $request->id;
		kelas::destroy($req_id);
		return redirect()->back()->with('succes','guru berhasil dihapus');	
	}
	
}