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

use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;

class tabelnilaiCtr extends Controller{
	public function tabelnilai (Request $request){
    	$get_iduji = $request->id_ujian;
		$tabelnilai = DB::table('kuis')
		->join('siswas','siswas.id','=','kuis.id_siswa')
		->select('*')
		->where('kuis.id_ujian','=',$get_iduji)
		->get();
		return view('tabelnilai', ['tabelnilai'=>$tabelnilai,'id_uji'=>$get_iduji]);

	}

	public function exportExcel($data)
	{
		return Excel::download(new ExcelExport($data), 'TabelNilai_'.date('d-m-Y').'.xlsx');
	}
}