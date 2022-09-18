<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class isimateri extends Model{

 	public $timestamps = false;
 	protected $fillable = ['id_ujion', 'materi_ujion', 'banyak'];
 }

?>