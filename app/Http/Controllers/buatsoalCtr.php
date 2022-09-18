<?php
namespace App\Http\Controllers;

use App\Models\banksoal;
use App\Models\guru;
use App\Models\bobot;
use App\Models\siswa;
use App\Models\mapel;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class buatsoalCtr extends Controller{
	public function buatsoal (){
		$result = banksoal::all();
	return view('buatsoal', ['result'=>$result]);
	}
	
	public function tambahmateriPost(Request $request){
		$this->validate($request, [
			'mapel' => 'required',
			'pilihmateri' => 'required',
			'jenissoal' => 'required',
			'bobot' => 'required',
			'soal' => 'required|unique:banksoals',
			'jawaban1' => 'required',
			'jawaban2' => 'required',
			'jawaban3' => 'required',
			'jawaban4' => 'required',
			'jawaban5' => 'required',
		]);
			$req_mapel = $request->mapel;
			$req_pilihmateri = $request->pilihmateri;
			$req_materi = $request->materi;
			$req_jenissoal = $request->jenissoal;
			$req_soal = $request->soal;
			$req_jwb_benarabc = $request->jwb_benarabc;
			$req_jwb_benares = $request->jwb_benar;
			$req_jawaban1 = $request->jawaban1;
			$req_jawaban2 = $request->jawaban2;
			$req_jawaban3 = $request->jawaban3;
			$req_jawaban4 = $request->jawaban4;
			$req_jawaban5 = $request->jawaban5;
			$req_bobot = $request->bobot;
			$materi="";
				if ($req_jwb_benarabc!="") {
					$req_jwb_benar=$req_jwb_benarabc;
				}else{
					$req_jwb_benar=$req_jwb_benares;
				}
					if ($req_pilihmateri=='new') {
						if ($req_materi!='') {
							$materi=$req_materi;
						}else{}
					}
					else {
						$materi=$req_pilihmateri;
					}		
						if ($req_jawaban1!="empty") {
							$jawaban=$req_jawaban1."&&".$req_jawaban2."&&".$req_jawaban3."&&".$req_jawaban4."&&".$req_jawaban5;
						}
						else{
							$jawaban="empty";
						}
							$ceksoal = banksoal::where('soal', '=', $req_soal)->get()->count();
							if ($req_bobot <= 10 && $ceksoal==0){
    							banksoal::create([
      								'mapel' => "$req_mapel",
      								'materi' => "$materi",
      								'kategori_soal' => "$req_jenissoal",
      								'soal' => "$req_soal",
      								'hasil_jawab' => "$req_jwb_benar",
      								'jawab' => "$jawaban",
      								'bobot' => "$req_bobot",
      								'id_guru' => $request->id_guru
    							]);
    								$getkodemapel=DB::table('mapels')->join('banksoals', 'banksoals.mapel', '=' , 'mapels.nama_mapel')
    											->where('banksoals.soal', '=', $req_soal)
    											->select('kode_mapel', 'banksoals.id', 'kategori_soal')
    											->get();
    									foreach ($getkodemapel as $data => $value) { 
      										$getkdmapel=$value->kode_mapel;
      										$getid=$value->id;
      										$getkat=$value->kategori_soal;
    									}
    										$setkat='';
    									if ($getkat=='esai') {
      										$setkat='ES';
    									}
    									else {
      										$setkat='PG';
    									}
    										$setkodemateri=substr($materi,0,3);
    										$getkodemateri=strtoupper($setkodemateri);
    										$createkode=$getkdmapel.$getkodemateri.$setkat.$getid;
	    										banksoal::find($getid)->update([
    	  											'kodesoal'=> $createkode
    											]);
  												bobot::create([
      												'bobot' => "$req_bobot",
      												'id_guru' => $request->id_guru,
      												'id_soal' => "$getid"
    											]);
  							}
								return redirect()->back()->with('succes','soal berhasil ditambah');
}

public function editsoal(Request $request){
	$id = $request->id;
	$result = banksoal::where('id',$id)->first();
return view('editsoal', ['result' => $result]);
}

public function updatesoalPost(Request $request){		
	$req_id = $request->id;
	$req_mapel = $request->mapel;
	$req_pilihmateri = $request->pilihmateri;
	$req_materi = $request->materi;
	$req_jenissoal = $request->jenissoal;
	$req_soal = $request->soal;
	$req_jwb_benares = $request->jwb_benar;
	$req_jwb_benarabc = $request->jwb_benarabc;
	$req_jawaban1 = $request->jawaban1;
	$req_jawaban2 = $request->jawaban2;
	$req_jawaban3 = $request->jawaban3;
	$req_jawaban4 = $request->jawaban4;
	$req_jawaban5 = $request->jawaban5;
	$req_bobot = $request->bobot;
	$materi="";
		if ($req_jwb_benarabc!="") {
			$req_jwb_benar=$req_jwb_benarabc;
		}else{
			$req_jwb_benar=$req_jwb_benares;
		}
			if ($req_pilihmateri=='new') {
				if ($req_materi!='') {
					$materi=$req_materi;
				}
				else{
				}
			}
			else {
				$materi=$req_pilihmateri;
			}
		
			if ($req_jawaban1!="empty") {
				$jawaban=$req_jawaban1."&&".$req_jawaban2."&&".$req_jawaban3."&&".$req_jawaban4."&&".$req_jawaban5;
			}else{
				$jawaban="empty";
			}
				if ($req_bobot <= 10){
    				banksoal::find($req_id)->update([
   						'mapel' => "$req_mapel",
   						'materi' => "$materi",
   						'kategori_soal' => "$req_jenissoal",
   						'soal' => "$req_soal",
   						'hasil_jawab' => "$req_jwb_benar",
   						'jawab' => "$jawaban",
   						'bobot' => $req_bobot,
   						'id_guru' => $request->id_guru
  					]);
  					$getkodemapel=DB::table('mapels')->join('banksoals', 'banksoals.mapel', '=' , 'mapels.nama_mapel')
  								->where('banksoals.soal', '=', $req_soal)
  								->select('kode_mapel', 'banksoals.id', 'kategori_soal')
  								->get();
  							foreach ($getkodemapel as $data => $value) { 
   								$getkdmapel=$value->kode_mapel;
   								$getid=$value->id;
   								$getkat=$value->kategori_soal;
  							}
  							$setkat='';
  							if ($getkat=='esai') {
   								$setkat='ES';
  							}
  							else {
   								$setkat='PG';
  							}
  								$setkodemateri=substr($materi,0,3);
  								$getkodemateri=strtoupper($setkodemateri);
  								$createkode=$getkdmapel.$getkodemateri.$setkat.$getid;
  									banksoal::find($getid)->update([
   										'kodesoal'=> $createkode
  									]);  
  					}
		return redirect('bobotsoal')->with('succes','soal berhasil ditambah');
}
}  