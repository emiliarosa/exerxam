<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class ujianoffline extends Model{

 	public $timestamps = false;
 	protected $fillable = ['nama_ujioff', 'id_guru'];
 }

?>