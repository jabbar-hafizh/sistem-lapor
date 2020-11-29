<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JenisKeluhanModel;

class BagianModel extends Model {
  protected $table = 'bagian';
  protected $fillable = ['nm_bagian'];
  protected $primaryKey = 'kd_bagian';
  public $incrementing = false;
  public $keyType = 'string';
  public $timestamps = false;

  /**
   * Get the bagian for the blog jenis keluhan.
   */
  public function jenisKeluhan()
  {
    return $this->hasMany(JenisKeluhanModel::class, 'kd_bagian', 'kd_bagian_fk');
  }
}
