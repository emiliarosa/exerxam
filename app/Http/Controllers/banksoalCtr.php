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

class banksoalCtr extends Controller{
	public function banksoal (){
	$get_kategori=Session::get('kategori');
	$result = banksoal::where('mapel',$get_kategori)->get();
	return view('banksoal', ['result'=>$result]);
	}
}