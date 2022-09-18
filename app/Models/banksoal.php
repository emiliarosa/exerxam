<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class banksoal extends Model{

 	public $timestamps = false;
 	protected $fillable = ['kodesoal', 'kategori_soal', 'soal', 'jawab', 'hasil_jawab', 'materi', 'mapel', 'id_guru', 'bobot', 'level'];
 }

?>