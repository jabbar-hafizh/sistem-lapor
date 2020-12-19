<?php

namespace App\Exports;

use App\Models\KaryawanModel;
use App\Keluhan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KeluhanExport2 implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $startDate;
    public $endDate;
    public $namaKaryawan;
    public function __construct($startDate, $endDate, $namaKaryawan){
        $this->KaryawanModel = new KaryawanModel();
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->namaKaryawan = $namaKaryawan;
    }
    public function collection()
    {
        return $this->KaryawanModel->dataKeluhan2($this->startDate, $this->endDate, $this->namaKaryawan);
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
            'Nama Karyawan Petugas',
            'No. Telepon Karyawan Petugas',
        ];
    }

}
