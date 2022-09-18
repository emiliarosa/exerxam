<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class ujianonline extends Model{

 	public $timestamps = false;
 	protected $fillable = ['nama_ujion', 'tipe_ujion',  'id_guru', 'waktu'];
 }

?>