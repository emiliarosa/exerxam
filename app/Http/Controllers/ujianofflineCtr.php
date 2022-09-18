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

class ujianofflineCtr extends Controller{
		public function view (){
		$get_id_guru=Session::get('id_guru');
		$viewuo = ujianoffline::where('id_guru',$get_id_guru)->get();
		return view('ujianoffline', ['ujianoffline'=>$viewuo]);
	}
	public function addnamaujioffPost(Request $request){
		$get_id_guru=Session::get('id_guru');
		$this->validate($request, [
			'nama_ujioff' => 'required'
		]);
		$req_nama_ujioff = $request->nama_ujioff;
		ujianoffline::create([
			'nama_ujioff' => "$req_nama_ujioff",
			'id_guru' => "$get_id_guru"
		]);  
		return redirect()->back()->with('succes','siswa berhasil ditambah');
	}
	public function hapusnamaujioffPost(Request $request){
    //$id_guru=$request->id_guru; -> id_guru dapatnya dari atribut input name form
    $req_id = $request->id;
    ujianoffline::destroy($req_id);
    isimateri_offline::where('id_ujioff','=',$req_id)->delete();
    return redirect()->back()->with('succes','kelas berhasil ditambah');
  }
  	public function editnamaujioffPost(Request $request){
		$this->validate($request, [
			'nama_ujioff' => 'required'
		]);
		$req_nama_ujioff = $request->nama_ujioff;
		$req_id = $request->id;
		ujianoffline::find($req_id)->update([
			'nama_ujioff' => "$req_nama_ujioff"
		]);
		return redirect()->back()->with('succes','kelas berhasil ditambah');
	}

	public function tambah_materi_offline(Request $request){
		$get_id=$request->id_ujian;
		$viewuo = ujianoffline::where('id',$get_id)->first();
		$viewmat = ujianoffline::join('isimateri_offlines','ujianofflines.id','=','isimateri_offlines.id_ujioff')
		->where('ujianofflines.id', $get_id)
		->get();
		return view('tambahmateri_offline', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat]);
	}
	public function setmateriujioffPost(Request $request){
		// $this->validate($request, [
		// 	'pilihmateri' => 'required',
		// 	'banyak_soal' => 'required',
		// 	'level' => 'required'
		// ]);
		$req_id_ujioff = $request->id_ujioff;
		if ($request->pilihmateri== null || $request->banyak_soal== null || $request->level == null) {
			$viewuo = ujianoffline::where('id',$req_id_ujioff)->first();
			$viewmat = ujianoffline::join('isimateri_offlines','ujianofflines.id','=','isimateri_offlines.id_ujioff')
			->where('ujianofflines.id', $req_id_ujioff)
			->get();
			return view('tambahmateri_offline', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat,'gagal'=>"isi dengan benar"]);
		
		}
		else{
		$req_pilihmateri = $request->pilihmateri;
		$req_banyak_soal = $request->banyak_soal;
		$req_level = $request->level;

		$get_kategori = $request->get_kategori;
		$cekmat = isimateri_offline::where('materi_ujioff',$req_pilihmateri)->where('level',$req_level)->where('id_ujioff',$req_id_ujioff)->count();
		$ceksoalmudah = banksoal::where('materi',$req_pilihmateri)->where('bobot','>=',0)->where('bobot','<=',3)->where('bobot','<=',6)->where('kategori_soal','esai')->count();
		$ceksoalsedang = banksoal::where('materi',$req_pilihmateri)->where('bobot','>',3)->where('bobot','<=',6)->where('kategori_soal','esai')->count();
		$ceksoalsulit = banksoal::where('materi',$req_pilihmateri)->where('bobot','>',6)->where('kategori_soal','esai')->count();
		$cekmatsoal = bobot::join('banksoals', 'banksoals.id', '=' , 'bobots.id_soal')->where('banksoals.materi', '=', $req_pilihmateri)->get();
		$getdataguru=guru::where('kategori_guru',$get_kategori)->get()->count();

		$ceksoalvalid=0;
		$soalvalid=0;
		$ceksoalidv="";
		foreach ($cekmatsoal as $keycekmatsoal) {
			$soalvalid++;
			$idsoal=$keycekmatsoal->id;
			$getcekbobot=bobot::where('id_soal',$idsoal)->get()->count();
			if($getdataguru==$getcekbobot){
				$ceksoalvalid++;
			}else{
				$ceksoalvalid--;
				$ceksoalidv="$ceksoalidv,$idsoal";
			}
		}
		//dd($cekmat,$req_banyak_soal,$ceksoalmudah,$req_banyak_soal,$ceksoalsedang,$req_banyak_soal,$ceksoalsulit,$ceksoalvalid,$soalvalid,$ceksoalidv);
				if($cekmat==0 && $req_banyak_soal<=$ceksoalmudah && $req_banyak_soal<=$ceksoalsedang && $req_banyak_soal<=$ceksoalsulit && $ceksoalvalid==$soalvalid){
			isimateri_offline::create([
			'materi_ujioff' => "$req_pilihmateri",
			'banyak' => "$req_banyak_soal",
			'level' => "$req_level",
			'id_ujioff' => "$req_id_ujioff"
			]);

			$viewuo = ujianoffline::where('id',$req_id_ujioff)->first();
			$viewmat = ujianoffline::join('isimateri_offlines','ujianofflines.id','=','isimateri_offlines.id_ujioff')
			->where('ujianofflines.id', $req_id_ujioff)
			->get();
			return view('tambahmateri_offline', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat,'succes'=>"berhasil"]);
				}else {
					
			$viewuo = ujianoffline::where('id',$req_id_ujioff)->first();
			$viewmat = ujianoffline::join('isimateri_offlines','ujianofflines.id','=','isimateri_offlines.id_ujioff')
			->where('ujianofflines.id', $req_id_ujioff)
			->get();
			return view('tambahmateri_offline', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat,'gagal'=>"kesalahan pada pemberian bobot atau materi sudah ada"]);
				}
			}
		
	}

	public function editmateriofflinePost(Request $request){
		// $this->validate($request, [
		// 	'pilihmateri' => 'required',
		// 	'banyak' => 'required',
		// 	'level' => 'required'
		// ]);
		$req_get_id_ujian = $request->get_id_ujian;
		if ($request->pilihmateri== null || $request->banyak== null || $request->level == null) {
			$viewuo = ujianoffline::where('id',$req_get_id_ujian)->first();
			$viewmat = ujianoffline::join('isimateri_offlines','ujianofflines.id','=','isimateri_offlines.id_ujioff')
			->where('ujianofflines.id', $req_get_id_ujian)
			->get();
			return view('tambahmateri_offline', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat,'gagal'=>"isi dengan benar"]);		
		}
		else{
		$req_materi = $request->pilihmateri;
		$req_banyak = $request->banyak;
		$req_level = $request->level;
		$req_id = $request->id;
		$get_kategori = $request->get_kategori;
		$cekmat = isimateri_offline::where('materi_ujioff',$req_materi)->where('level',$req_level)->where('id_ujioff',$req_get_id_ujian)->where('id','!=',$req_id)->count();
		$ceksoalmudah = banksoal::where('materi',$req_materi)->where('bobot','>=',0)->where('bobot','<=',3)->count();
		$ceksoalsedang = banksoal::where('materi',$req_materi)->where('bobot','>',3)->where('bobot','<=',6)->count();
		$ceksoalsulit = banksoal::where('materi',$req_materi)->where('bobot','>',6)->count();
		$cekmatsoal = bobot::join('banksoals', 'banksoals.id', '=' , 'bobots.id_soal')->where('banksoals.materi', '=', $req_materi)->get();
		$getdataguru=guru::where('kategori_guru',$get_kategori)->get()->count();

		$ceksoalvalid=0;
		$soalvalid=0;
		foreach ($cekmatsoal as $keycekmatsoal) {
			$soalvalid++;
			$idsoal=$keycekmatsoal->id;
			$getcekbobot=bobot::where('id_soal',$idsoal)->get()->count();
			if($getdataguru==$getcekbobot){
				$ceksoalvalid++;
			}else{
				$ceksoalvalid--;
			}
		}
				if($cekmat<=1 && $req_banyak<=$ceksoalmudah && $req_banyak<=$ceksoalsedang && $req_banyak<=$ceksoalsulit && $ceksoalvalid==$soalvalid){

		isimateri_offline::find($req_id)->update([
			'materi_ujioff' => "$req_materi",
			'banyak' => "$req_banyak",
			'level' => "$req_level",
			'id_ujioff' => "$req_get_id_ujian"
		]);
		$viewuo = ujianoffline::where('id',$req_get_id_ujian)->first();
		$viewmat = ujianoffline::join('isimateri_offlines','ujianofflines.id','=','isimateri_offlines.id_ujioff')
		->where('ujianofflines.id', $req_get_id_ujian)
		->get();
		return view('tambahmateri_offline', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat,'succes'=>"berhasil"]);
	}else{
		$viewuo = ujianoffline::where('id',$req_get_id_ujian)->first();
		$viewmat = ujianoffline::join('isimateri_offline','ujianofflines.id','=','isimateri_offline.id_ujioff')
		->where('ujianofflines.id', $req_get_id_ujian)
		->get();
		return view('tambahmateri_offline', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat,'gagal'=>"kesalahan pada pemberian bobot atau materi sudah ada"]);
	}
}
	}
	public function hapusmaterioffline(Request $request){
		//$id_guru=$request->id_guru; -> id_guru dapatnya dari atribut input name form
		$req_id_ujioff = $request->id_ujioff;
		$req_id = $request->id;
		isimateri_offline::destroy($req_id);

		$viewuo = ujianoffline::where('id',$req_id_ujioff)->first();
		$viewmat = ujianoffline::join('isimateri_offlines','ujianofflines.id','=','isimateri_offlines.id_ujioff')
		->where('ujianofflines.id', $req_id_ujioff)
		->get();
		return view('tambahmateri_offline', ['ujioffline'=>$viewuo,'viewmateri'=>$viewmat]);
	}
  public function random(Request $request){
    $req_id_ujioff = $request->id_ujioff;
    $req_banyak = $request->banyak_soal;
    for ($i=1; $i<=$req_banyak; $i++) {
    $setsoal = "";
      $getujian = isimateri_offline::where('id_ujioff',$req_id_ujioff)->distinct()->get();
      $soaldpt="";
      
    foreach ($getujian as $dataujian) {
      $materi=$dataujian->materi_ujioff;
      $banyak=$dataujian->banyak;
      $level=$dataujian->level;
      $get_soal=banksoal::where('materi',$materi)->where('kategori_soal','!=','abcde')->get();


      $setsoalmudah="";
      $setsoalsedang="";
      $setsoalsulit="";

      foreach ($get_soal as $datasoal) {
        $id_soal=$datasoal->id;
        $bobot=$datasoal->bobot;
        if($bobot>=1 && $bobot<=3){
          if($setsoalmudah==""){
          $setsoalmudah="$id_soal";
          } else{
          $setsoalmudah="$setsoalmudah,$id_soal";
          }
        }
                elseif($bobot>3 && $bobot<=6){
                  if($setsoalsedang==""){
                  $setsoalsedang="$id_soal";
                  } else{
                  $setsoalsedang="$setsoalsedang,$id_soal";
                  }
                }
                elseif($bobot>6 && $bobot<=10){
                  if($setsoalsulit==""){
                  $setsoalsulit="$id_soal";
                  } else{
                  $setsoalsulit="$setsoalsulit,$id_soal";
                  }
                }

            }

            $fishermudah1=fisheryates::random($setsoalmudah);
            $fishermudah=fisheryates::random($fishermudah1);
            $soalmudahfin = explode(',',$fishermudah);

            $setbanyak=0;
      $cekbanyak=$banyak;
if($level == "Mudah"){
  
      foreach($soalmudahfin as $soalmudah1=>$mudah){
            $setbanyak++;
            if($setbanyak<=$cekbanyak){
              if($soaldpt==""){
          $soaldpt="$mudah";
          } else{
          $soaldpt="$soaldpt,$mudah";
          }
        }
      }
}

      $fishersedang1=fisheryates::random($setsoalsedang);
      $fishersedang=fisheryates::random($fishersedang1);
            $soalsedangfin = explode(',',$fishersedang);

            $setbanyak=0;
      $cekbanyak=$banyak;
if($level == "Sedang"){
      foreach($soalsedangfin as $soalsedang1=>$sedang){
            $setbanyak++;
            if($setbanyak<=$cekbanyak){
              if($soaldpt==""){
          $soaldpt="$sedang";
          } else{
          $soaldpt="$soaldpt,$sedang";
          }
        }
      }
   }

      $fishersulit1=fisheryates::random($setsoalsulit);
      $fishersulit=fisheryates::random($fishersulit1);
            $soalsulitfin = explode(',',$fishersulit);

            $setbanyak=0;
      $cekbanyak=$banyak;
if($level == "Sulit"){
      foreach($soalsulitfin as $soalsulit1=>$sulit){
            $setbanyak++;
            if($setbanyak<=$cekbanyak){
              if($soaldpt==""){
          $soaldpt="$sulit";
          } else{
          $soaldpt="$soaldpt,$sulit";
          }
        }
      }
}
      }
      //dd($soalmudah);
      kuis_ujianoffline::create([
      'id_ujian' => "$req_id_ujioff",
      'soal' => "$soaldpt"
    ]);
    }
    return redirect("soaloffline?id_ujian=$req_id_ujioff");
  }

  public function soaloffline(Request $request){
  	$get_id_ujian=$request->id_ujian;
  	$kuis_ujianoffline=kuis_ujianoffline::where('id_ujian',$get_id_ujian)->get();
  	return view('soaloffline',['ujioffline'=>$kuis_ujianoffline]);
  }
}