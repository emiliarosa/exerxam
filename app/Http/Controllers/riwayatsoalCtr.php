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
use App\Http\Services\fisheryates;
use App\Models\banksoal;
use App\Models\bobot;
use App\Models\guru;
use Illuminate\Support\Facades\Session;

class riwayatsoalCtr extends Controller{
		public function riwayatsoal (){
		$get_id_guru=Session::get('id_guru');
		$viewuo = ujianonline::where('id_guru',$get_id_guru)->get();
		return view('riwayatsoal', ['ujianonline'=>$viewuo]);
	}
}