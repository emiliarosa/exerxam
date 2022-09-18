<?php

namespace App\Http\Services;

class fisheryates
{
	
	public static function random($get_id_soal){

	$id_soal = explode(",", $get_id_soal);
	$i=count($id_soal);
	$ran_id_soal=$get_id_soal;
	$hsl_random="";
	while(--$i){//random semua sesuai jumlah id soal
		$random_id=$ran_id_soal;
		$hsl_a = explode(",", $random_id);//mengambil yg akan hilang
		$hsl = explode(",", $random_id);//sisannya dari data yg sudah diambil
		$a=count($hsl);//a:pnjg array
			while(--$a){//mengambil 1 id
				$y=mt_rand(0,$a-1);//
				$j=mt_rand($y,$a);//fungsi untuk random
				if($a != $j){//j : 
				$tmp = $hsl[$a];
				$hsl[$j] = $hsl[$a];
				$hsl[$a] = $tmp;
				}
			} 	
		$set_ran="";
    
		foreach($hsl_a as $dhasl=>$key){//menghilangkan 1 id dan set dr awal lg setelah id sudah dihilangkan
			if($key!=$hsl[0]){//diambil data 1
				if($set_ran==""){
				$set_ran="$key";
				}
				else{
				$set_ran="$set_ran,$key";
				}
			$ran_id_soal=$set_ran;
			}
		}
		// echo "<br>Ilang $hsl[0]<br>";
		// echo "<br>$ran_id_soal";
		if ($hsl_random=="") {//
			$hsl_random="$hsl[0]";//
		}
		else{
			$hsl_random="$hsl_random,$hsl[0]";
		}
	}
	$hsl_random="$hsl_random,$ran_id_soal";//$ran_id_soal : sisa hasil terakhir pengambilan. $hsl_random = hasil pengambilan.
	return $hsl_random;
	// echo "<br>";
	// echo "<br>";
	// echo $hsl_random;
	// echo "<br>";
	// echo $get_id_soal;
	}
}