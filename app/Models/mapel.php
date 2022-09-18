<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class mapel extends Model{

 	public $timestamps = false;
 	protected $fillable = ['nama_mapel', 'kode_mapel'];
 }

?>