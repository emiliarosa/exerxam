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

class ujianonlineCtr extends Controller{
		public function view (){
		$get_id_guru=Session::get('id_guru');
		$viewuo = ujianonline::where('id_guru',$get_id_guru)->get();
		return view('ujianonline', ['ujianonline'=>$viewuo]);
	}

	public function addketentuanPost(Request $request){
		$get_id_guru=Session::get('id_guru');
		$this->validate($request, [
			'pilihketentuan' => 'required',
			'nama_ujion' => 'required'
		]);
		$req_pilihketentuan = $request->pilihketentuan;
		$req_nama_ujion = $request->nama_ujion;
		$detik = $request->detik;
		$menit = $request->menit;
		$waktu = "$menit,$detik";
		ujianonline::create([
			'tipe_ujion' => "$req_pilihketentuan",
			'nama_ujion' => "$req_nama_ujion",
			'waktu' => "$waktu",
			'id_guru' => "$get_id_guru"
		]);
		return redirect('ujianonline')->with('succes','ujian baru berhasil ditambah');
	}
	public function hapusPost(Request $request){
    //$id_guru=$request->id_guru; -> id_guru dapatnya dari atribut input name form
    $req_id = $request->id;
    ujianonline::destroy($req_id);
    isimateri::where('id_ujion','=',$req_id)->delete();
    kuis::where('id_ujian','=',$req_id)->delete();
    return redirect()->back()->with('succes','ujian baru berhasil dihapus');
  }
  	public function editPost(Request $request){
		$this->validate($request, [
			'pilihketentuan' => 'required',
			'nama_ujion' => 'required'
		]);
		$req_pilihketentuan = $request->pilihketentuan;
		$req_nama_ujion = $request->nama_ujion;
		$req_id = $request->id;
		$detik = $request->detik;
		$menit = $request->menit;
		$waktu = "$menit,$detik";
		ujianonline::find($req_id)->update([
			'tipe_ujion' => "$req_pilihketentuan",
			'nama_ujion' => "$req_nama_ujion",
			'waktu' => "$waktu"
		]);
		return redirect()->back()->with('succes','ujian baru berhasil diedit');
	}
	public function tambah_materi(Request $request){
		$get_id=$request->id_ujian;
		$viewuo = ujianonline::where('id',$get_id)->first();
		$viewmat = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $get_id)
		->get();
		return view('tambahmateri', ['ujionline'=>$viewuo,'viewmateri'=>$viewmat]);
	}
	public function setmateriPost(Request $request){
		$this->validate($request, [
			'pilihmateri' => 'required',
			'banyak_soal' => 'required'
		]);
		$req_id_ujion = $request->id_ujion;
		$req_pilihmateri = $request->pilihmateri;
		$req_banyak_soal = $request->banyak_soal;

		$get_kategori = $request->get_kategori;
		$cekmat = isimateri::where('materi_ujion',$req_pilihmateri)->where('id_ujion',$req_id_ujion)->count();
		$ceksoalmudah = banksoal::where('materi',$req_pilihmateri)->where('bobot','>=',0)->where('bobot','<=',3)->where('kategori_soal','abcde')->count();
		$ceksoalsedang = banksoal::where('materi',$req_pilihmateri)->where('bobot','>',3)->where('bobot','<=',6)->where('kategori_soal','abcde')->count();
		$ceksoalsulit = banksoal::where('materi',$req_pilihmateri)->where('bobot','>',6)->where('kategori_soal','abcde')->count();
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
		//if($cekmat==0 && $req_banyak_soal<=$ceksoalmudah && $req_banyak_soal<=$ceksoalsedang && $req_banyak_soal<=$ceksoalsulit && $req_banyak_soal<=$ceksoalvalid && $req_banyak_soal<=$ceksoalvalid && $req_banyak_soal<=$ceksoalvalid){
		isimateri::create([
			'materi_ujion' => "$req_pilihmateri",
			'banyak' => "$req_banyak_soal",
			'id_ujion' => "$req_id_ujion"
		]);
		$viewuo = ujianonline::where('id',$req_id_ujion)->first();
		$viewmat = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $req_id_ujion)
		->get();
		return view('tambahmateri', ['ujionline'=>$viewuo,'viewmateri'=>$viewmat,'succes'=>"berhasil"]);
	}
	else if($req_banyak_soal>$ceksoalmudah && $req_banyak_soal>$ceksoalsedang && $req_banyak_soal>$ceksoalsulit){
		$viewuo = ujianonline::where('id',$req_id_ujion)->first();
		$viewmat = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $req_id_ujion)
		->get();
		return view('tambahmateri', ['ujionline'=>$viewuo,'viewmateri'=>$viewmat,'gagal'=>"soal adalah kategori essay"]);
	}
	else{
		$viewuo = ujianonline::where('id',$req_id_ujion)->first();
		$viewmat = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $req_id_ujion)
		->get();
		return view('tambahmateri', ['ujionline'=>$viewuo,'viewmateri'=>$viewmat,'gagal'=>"kesalahan pada pemberian bobot atau materi sudah ada"]);
	}
	}
	public function editmateriPost(Request $request){
		$this->validate($request, [
			'pilihmateri' => 'required',
			'banyak' => 'required'
		]);
		$req_materi = $request->pilihmateri;
		$req_banyak = $request->banyak;
		$req_id = $request->id;
		$req_get_id_ujian = $request->get_id_ujian;
		$get_kategori = $request->get_kategori;
		$cekmat = isimateri::where('materi_ujion',$req_materi)->where('id_ujion',$req_get_id_ujian)->where('id','!=',$req_id)->count();
		$ceksoalmudah = banksoal::where('materi',$req_materi)->where('bobot','>=',0)->where('bobot','<=',3)->where('kategori_soal','abcde')->count();
		$ceksoalsedang = banksoal::where('materi',$req_materi)->where('bobot','>',3)->where('bobot','<=',6)->where('kategori_soal','abcde')->count();
		$ceksoalsulit = banksoal::where('materi',$req_materi)->where('bobot','>',6)->where('kategori_soal','abcde')->count();
		$cekmatsoal = bobot::join('banksoals', 'banksoals.id', '=' , 'bobots.id_soal')->where('banksoals.materi', '=', $req_materi)->get();
		$getdataguru=guru::where('kategori_guru',$get_kategori)->get()->count();

		$ceksoalvalid=0;
		$soalvalid=0;
		//$ceksoalidv="";
		foreach ($cekmatsoal as $keycekmatsoal) {
			$soalvalid++;
			$idsoal=$keycekmatsoal->id;
			$getcekbobot=bobot::where('id_soal',$idsoal)->get()->count();
			if($getdataguru==$getcekbobot){
				$ceksoalvalid++;
			}else{
				$ceksoalvalid--;
					//$ceksoalidv="$ceksoalidv,$idsoal";
			}
		}
		//dd($cekmat,$req_banyak,$ceksoalmudah,$req_banyak,$ceksoalsedang,$req_banyak,$ceksoalsulit,$ceksoalvalid,$soalvalid,$ceksoalidv);
	if($cekmat==0 && $req_banyak<=$ceksoalmudah && $req_banyak<=$ceksoalsedang && $req_banyak<=$ceksoalsulit && $ceksoalvalid==$soalvalid){
		isimateri::find($req_id)->update([
			'materi_ujion' => "$req_materi",
			'banyak' => "$req_banyak",
			'id_ujion' => "$req_get_id_ujian"
		]);
		$viewuo = ujianonline::where('id',$req_get_id_ujian)->first();
		$viewmat = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $req_get_id_ujian)
		->get();
		return view('tambahmateri', ['ujionline'=>$viewuo,'viewmateri'=>$viewmat,'succes'=>"berhasil"]);
	}
	else if($req_banyak>$ceksoalmudah && $req_banyak>$ceksoalsedang && $req_banyak>$ceksoalsulit){
		$viewuo = ujianonline::where('id',$req_get_id_ujian)->first();
		$viewmat = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $req_get_id_ujian)
		->get();
		return view('tambahmateri', ['ujionline'=>$viewuo,'viewmateri'=>$viewmat,'gagal'=>"soal adalah kategori essay"]);
	}
	else{
		$viewuo = ujianonline::where('id',$req_get_id_ujian)->first();
		$viewmat = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $req_get_id_ujian)
		->get();
		return view('tambahmateri', ['ujionline'=>$viewuo,'viewmateri'=>$viewmat,'gagal'=>"kesalahan pada pemberian bobot atau materi sudah ada"]);
	}
	}
	public function hapusmateriPost(Request $request){
		//$id_guru=$request->id_guru; -> id_guru dapatnya dari atribut input name form
		$req_id_ujion = $request->id_ujion;
		$req_id = $request->id;   
		isimateri::destroy($req_id);

		$viewuo = ujianonline::where('id',$req_id_ujion)->first();
		$viewmat = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $req_id_ujion)
		->get();
		return view('tambahmateri', ['ujionline'=>$viewuo,'viewmateri'=>$viewmat]);
	}
	public function bagikan(Request $request){
		$req_id_ujion = $request->id_ujion;
		$req_kelas = $request->kelas;
		$getsiswa = siswa::where('kelas',$req_kelas)->get();
		$ceksiswa = siswa::where('kelas',$req_kelas)->get()->count();
		$cekkuis=0;
		foreach ($getsiswa as $datasiswa) {
		$setsoal = "";
			$id_siswa=$datasiswa->id;
		$cekkuis = kuis::where('id_ujian',$req_id_ujion)->where('id_siswa',$id_siswa)->get()->count();
		//dd($cekkuis);
		if ($cekkuis==0) {
			$getujian = isimateri::where('id_ujion',$req_id_ujion)->distinct()->get();
			$soalmudah="";
			$soalsedang="";
			$soalsulit="";
		foreach ($getujian as $dataujian) {
			$materi=$dataujian->materi_ujion;
			$banyak=$dataujian->banyak;
			$get_soal=banksoal::where('materi',$materi)->where('kategori_soal','abcde')->get();


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

			foreach($soalmudahfin as $soalmudah1=>$mudah){
            $setbanyak++;
            if($setbanyak<=$cekbanyak){
            	if($soalmudah==""){
					$soalmudah="$mudah";
					} else{
					$soalmudah="$soalmudah,$mudah";
					}
				}
			}
			$fishersedang1=fisheryates::random($setsoalsedang);
			$fishersedang=fisheryates::random($fishersedang1);
            $soalsedangfin = explode(',',$fishersedang);

            $setbanyak=0;
			$cekbanyak=$banyak;

			foreach($soalsedangfin as $soalsedang1=>$sedang){
            $setbanyak++;
            if($setbanyak<=$cekbanyak){
            	if($soalsedang==""){
					$soalsedang="$sedang";
					} else{
					$soalsedang="$soalsedang,$sedang";
					}
				}
			}

			$fishersulit1=fisheryates::random($setsoalsulit);
			$fishersulit=fisheryates::random($fishersulit1);
            $soalsulitfin = explode(',',$fishersulit);

            $setbanyak=0;
			$cekbanyak=$banyak;

			foreach($soalsulitfin as $soalsulit1=>$sulit){
            $setbanyak++;
            if($setbanyak<=$cekbanyak){
            	if($soalsulit==""){
					$soalsulit="$sulit";
					} else{
					$soalsulit="$soalsulit,$sulit";
					}
				}
			}

			}
			//dd($soalmudah);
			kuis::create([
			'id_siswa' => "$id_siswa",
			'id_ujian' => "$req_id_ujion",
			'soal_mudah' => "$soalmudah",
			'soal_sedang' => "$soalsedang",
			'soal_sulit' => "$soalsulit"
		]);
		}
	}
	if ($cekkuis==0 && $ceksiswa>0) {
		return redirect('ujianonline')->with('succes','berhasil share ujian');
	}elseif ($ceksiswa==0) {
		return redirect('ujianonline')->with('gagal','ada siswa yang belum mendaftarkan akun');
	}
	else{
		return redirect('ujianonline')->with('gagal','ujian sudah dilakukan');
	}
		
	}
	public function kuisonline(Request $request){
		$get_id_siswa = $request->id_siswa;
		$get_id_ujian = $request->id_ujian;
		// $getsoal = kuis::join('ujianonlines','ujianonlines.id','=','kuis.id_ujian')->where('id_siswa',$get_id_siswa)->where('id_ujian',$get_id_ujian)->where('soal_dapat',null)->first();
		$getsoal = kuis::join('ujianonlines','ujianonlines.id','=','kuis.id_ujian')->where('id_siswa',$get_id_siswa)->where('id_ujian',$get_id_ujian)->first();
		return view('kuis',['soal'=>$getsoal]);
	}
	
	public function fsendjwb(Request $request){
    $get_idsiswa = $request->id_siswa;
    $get_iduji = $request->id_ujian;
    $get_soal = $request->ikisoal;
    $get_jwb = substr($request->jwb,4,1);
    $cek=kuis::where('id_siswa',$get_idsiswa)->where('id_ujian',$get_iduji)->get()->first();
    if($cek->soal_dapat == null){
    kuis::where('id_siswa',$get_idsiswa)->where('id_ujian',$get_iduji)->update([
      'soal_dapat' => "$get_soal",
      'jawaban' => "$get_jwb"
    ]);
  }else {
    $soaldapat = $cek->soal_dapat;
    $jawaban = $cek->jawaban;
    kuis::where('id_siswa',$get_idsiswa)->where('id_ujian',$get_iduji)->update([
      'soal_dapat' => "$soaldapat&&$get_soal",
      'jawaban' => "$jawaban&&$get_jwb"
    ]);
  }
    return response()->json(['result'=>'succes']);
    }

    public function tabelsiswa(Request $request){//login sbg siswa
		$get_id_siswa=Session::get('id_siswa');
		$tabelsiswa = DB::table('ujianonlines')
		->join('kuis','kuis.id_ujian','=','ujianonlines.id')
		->join('gurus','gurus.id','=','ujianonlines.id_guru')
		->select('ujianonlines.id','ujianonlines.nama_ujion','ujianonlines.tipe_ujion','gurus.kategori_guru','kuis.jawaban')
		->where('kuis.id_siswa','=',$get_id_siswa)
		->whereNull('kuis.jawaban')
		->get();
		return view('ujionsiswa', ['ujisiswa'=>$tabelsiswa]);//dataguru : halamannya=>di blade berarti @dataguru
	}

	public function fsendscr(Request $request){
    $get_idsiswa = $request->id_siswa;
    $get_iduji = $request->id_ujian;
    $get_scr = $request->scr;
    $cek=kuis::where('id_siswa',$get_idsiswa)->where('id_ujian',$get_iduji)->get()->first();
    if($cek->soal_dapat != null){
    kuis::where('id_siswa',$get_idsiswa)->where('id_ujian',$get_iduji)->update([
      'skor' => "$get_scr"
    ]);
  }
    return response()->json(['result'=>'succes']);
    }

public function grafik(Request $request){
		$id_ujian = $request->id_ujian;
    	$kuis = DB::table('kuis')
		->select('soal_dapat','jawaban')
		->where('id_ujian','=',$id_ujian)
		->get();
		$materi = ujianonline::join('isimateris','ujianonlines.id','=','isimateris.id_ujion')
		->where('ujianonlines.id', $id_ujian)
		->get();
		// echo json_encode($materi);die();
		$arr = array();
		$arr[0] = 1;
		$presentase = array();
		$nama_materi = array();
		foreach ($materi as $key => $value) {
			$benar = 0;
			$jumlah_soal = 0;
			$nama_materi[$key] = $value->materi_ujion;
			$arr[$key+1] = $arr[$key]+$value->banyak;
			for ($i=$arr[$key]; $i < $arr[$key+1]; $i++) { 
				foreach ($kuis as $keys => $values) {
					if ($values->soal_dapat!=null && $values->jawaban!=null) {
						$soal = explode('&&', $values->soal_dapat);
						$jawab = explode('&&', $values->jawaban);
						$bank_soal = DB::table('banksoals')
						->select('hasil_jawab')
						->where('id','=',trim($soal[$i-1], "'"))
						->get();
						if ($bank_soal[0]->hasil_jawab=="<p>".$jawab[$i-1]."</p>") {
							$benar++;
						}
						$jumlah_soal++;
					}
				}
			}
			$presentase[$key] = $benar!=0?round(($benar/$jumlah_soal)*100,2):0;
		}
		// echo json_encode($nama_materi);die();
		return view('grafik', ['materi'=>$nama_materi,'presentase'=>$presentase]);
	}

	public function grafiksiswa(Request $request){
		$get_id_siswa=Session::get('id_siswa');
		$id_uji=$request->id_uji;
		$grp=kuis::where('id_siswa',$get_id_siswa)->where('id_ujian',$id_uji)->get()->first();
		$dpt=$grp->soal_dapat;
          $mdh=str_replace(",", ',-', $grp->soal_mudah);
          $sdg=str_replace(",", ',-', $grp->soal_sedang);
          $slt=str_replace(",", ',-', $grp->soal_sulit);
          $sdpt=str_replace("'", '', $dpt);
          $sdpt=str_replace(" ", '', $sdpt);
          $soaldpt = explode('&&',$sdpt);
          	$grapik=null;
          	//dd($soaldpt);
          foreach($soaldpt as $soaldpt1=>$dpt1){
          	$cekmdh=strpos("@-".$mdh,"-".$dpt1);
          	$ceksdg=strpos("@-".$sdg,"-".$dpt1);
          	$cekslt=strpos("@-".$slt,"-".$dpt1);
          //dd($ceksdg,$dpt1,$sdg);
          	if($cekmdh!=""){
          		$grapik[]=['soal'=>$dpt1,'nil' => 0];
          	}
          	else if($ceksdg!=""){
          		$grapik[]=['soal'=>$dpt1,'nil' => 10];
          	}
          	else if($cekslt!=""){
          		$grapik[]=['soal'=>$dpt1,'nil' => 20];
          	}
          }
          //dd($grapik);
		return view('grafiksiswa', ['grp'=>$grapik]);
	}
}