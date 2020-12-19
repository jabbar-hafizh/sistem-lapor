<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BagianModel;

class JenisKeluhanModel extends Model {
  protected $table = 'jenis_keluhan';
  protected $fillable = ['nm_keluhan', 'id_jenis_keluhan'];
  protected $primaryKey = 'id_jenis_keluhan';
  public $incrementing = false;
  protected $keyType = 'string';
  public $timestamps = false;
}
