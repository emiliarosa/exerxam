<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class kuis extends Model{

 	public $timestamps = false;
 	protected $fillable = ['id_siswa', 'id_ujian', 'soal_mudah', 'soal_sedang', 'soal_sulit', 'soal_dapat', 'jawaban', 'skor'];
 }

?>