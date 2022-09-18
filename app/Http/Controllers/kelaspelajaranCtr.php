<?php
namespace App\Http\Controllers;

use App\Models\mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class kelaspelajaranCtr extends Controller{
	public function view (){
		$viewmapel = mapel::all();
		return view('kelaspelajaran', ['mapel'=>$viewmapel]);
	}

	public function tambahpelajaranPost(Request $request){
		$this->validate($request, [
			'nama_mapel' => 'required|unique:mapels',
			'kode_mapel' => 'required|unique:mapels'
		]);
		$req_nama_mapel = $request->nama_mapel;
		$req_kode_mapel = $request->kode_mapel;
		mapel::create([
			'nama_mapel' => "$req_nama_mapel",
			'kode_mapel' => "$req_kode_mapel"
		]);
		return redirect()->back()->with('succes','mapel berhasil ditambah');
	}
	public function editmapelPost(Request $request){
		$this->validate($request, [
			'nama_mapel' => 'required',
			'kode_mapel' => 'required'
		]);
		$req_nama_mapel = $request->nama_mapel;
		$req_kode_mapel = $request->kode_mapel;
		$req_id = $request->id;
		mapel::find($req_id)->update([
			'nama_mapel' => "$req_nama_mapel",
			'kode_mapel' => "$req_kode_mapel"
		]);
		return redirect()->back()->with('succes','mapel berhasil ditambah');
	}
	public function hapusmapelPost(Request $request){
		//$id_guru=$request->id; -> id dapatnya dari atribut input name form
		$req_id = $request->id;
		mapel::destroy($req_id);
		return redirect()->back()->with('succes','guru berhasil dihapus');	
	}
	
}