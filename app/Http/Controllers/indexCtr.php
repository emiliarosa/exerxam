<?php
namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class indexCtr extends Controller{
		public function index (){
		return view('index');
	}
}