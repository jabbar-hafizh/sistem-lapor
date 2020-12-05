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
    public function __construct(){
        $this->KaryawanModel = new KaryawanModel();
    }
    public function collection()
    {
        return $this->KaryawanModel->dataKeluhan();
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
