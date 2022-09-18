<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class isimateri_offline extends Model{

 	public $timestamps = false;
 	protected $fillable = ['id_ujioff', 'materi_ujioff', 'banyak', 'level'];
 }

?>