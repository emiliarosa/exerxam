<?php
namespace App\Http\Controllers;

use App\Models\ujianonline;
use App\Models\isimateri;
use App\Models\kuis;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\banksoal;
use App\Models\bobot;
use App\Models\guru;
use Illuminate\Support\Facades\Session;

class riwayatujiansiswaCtr extends Controller{
	public function view(){
		// $get_id_guru=Session::get('id_guru');
		// $viewuo = ujianonline::where('id_guru',$get_id_guru)->get();
		$get_id_siswa=Session::get('id_siswa');
		$tabelsiswa = DB::table('ujianonlines')
		->join('kuis','kuis.id_ujian','=','ujianonlines.id')
		->join('gurus','gurus.id','=','ujianonlines.id_guru')
		->select('ujianonlines.id','ujianonlines.nama_ujion','ujianonlines.tipe_ujion','gurus.kategori_guru','kuis.jawaban','kuis.skor')
		->where('kuis.id_siswa','=',$get_id_siswa)
		->whereNotNull('kuis.jawaban')
		->get();
		return view('riwayatujiansiswa', ['ujianonline'=>$tabelsiswa]);
	}
}