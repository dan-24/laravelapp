<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = array('nama_kategori', 'keterangan');

    public function barang()
    {
        return $this->hasMany('App\Barang');
    }
}
