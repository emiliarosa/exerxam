<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class siswa extends Model{

 	public $timestamps = false;
 	protected $fillable = ['id_users', 'nisn', 'nama_siswa', 'kelas'];
 }

?>