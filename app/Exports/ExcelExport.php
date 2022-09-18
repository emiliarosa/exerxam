<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExcelExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data)
    {
    	$this->data = $data;
    }

    public function collection()
    {
        $tabelnilai = DB::table('kuis')
		->join('siswas','siswas.id','=','kuis.id_siswa')
		->select('siswas.nama_siswa','kuis.skor')
		->where('kuis.id_ujian','=',$this->data)
		->get();
		return $tabelnilai;
    }

    public function headings(): array
    {
    	return [
    		'Nama_siswa',
    		'Skor'
    	];
    }
}
