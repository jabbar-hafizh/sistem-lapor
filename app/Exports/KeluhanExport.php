<?php

namespace App\Exports;

use App\Models\KaryawanModel;
use App\Keluhan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KeluhanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $startDate;
    public $endDate;
    public function __construct($startDate, $endDate){
        $this->KaryawanModel = new KaryawanModel();
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function collection()
    {
        return $this->KaryawanModel->dataKeluhan($this->startDate, $this->endDate);
    }
    public function headings(): array
    {
        return [
            'Nama Keluhan',
            'Penjelasan Keluhan',
            'Waktu Keluhan',
            'Nama Pengguna Jalan',
            'No. Telepon Pengguna Jalan',
            'Status',
            'Nama Petugas',
            'No. Telepon Petugas',
            'Tingkat Keluhan',
            'Shift'
        ];
    }

}
