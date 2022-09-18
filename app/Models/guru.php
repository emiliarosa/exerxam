<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class guru extends Model{

 	public $timestamps = false;
 	protected $fillable = ['id_users', 'nip_guru', 'nama_guru', 'kategori_guru'];
 }

?>