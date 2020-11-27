<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    public function allData(){
        return DB::table('tbl_report')
        ->leftJoin('tbl_admin', 'tbl_admin.id_admin', '=', 'tbl_report.id_report')
        ->get();
    }

    public function detailData($id_report){
        return DB::table('tbl_report')->where('id_report', $id_report)->first();
    }
}
