<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class bobot extends Model{

 	public $timestamps = false;
 	protected $fillable = ['id_guru', 'bobot', 'id_soal'];
 }

?>