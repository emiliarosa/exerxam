<?php
namespace App\Http\Controllers;

use App\Models\ujianoffline;
use App\Models\isimateri_offline;
use App\Models\kuis_ujianoffline;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Http\Services\fisheryates;
use App\Models\banksoal;
use App\Models\bobot;
use App\Models\guru;
use Illuminate\Support\Facades\Session;

class riwayatrandomCtr extends Controller{
	public function riwayatrandom (){
		$tabelrandom = DB::table('ujianofflines')
		->join('isimateri_offlines','isimateri_offlines.id_ujioff','=','ujianofflines.id')
		->select('ujianofflines.id','ujianofflines.nama_ujioff','isimateri_offlines.materi_ujioff','isimateri_offlines.banyak')
		->distinct()->get();
		return view('riwayatrandom', ['riwayatrandom'=>$tabelrandom]);

		/*$get_id=$request->id_ujian;
		$viewuo = ujianoffline::where('id',$get_id)->first();
		$viewmat = ujianoffline::join('isimateri_offlines','ujianofflines.id','=','isimateri_offlines.id_ujioff')
		->where('ujianofflines.id', $get_id)
		->get();
		return view('riwayatrandom', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat]);*/
	}
}