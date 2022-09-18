<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class kelas extends Model{

 	public $timestamps = false;
 	protected $fillable = ['kode_kelas', 'nama_kelas'];
 }

?>