<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{

    protected $guarded = ['id'];

    protected $fillable = ['nama_perusahaan', 'nama_agen', 'no_telphone', 'email', 'kota', 'provinsi', 'alamat','keterangan'];

    public function barang()
    {
        return $this->hasMany('App\Barang');
    }
}
