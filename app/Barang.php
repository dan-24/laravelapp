<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['nama_barang', 'kategori_id', 'suplier_id', 'stock', 'harga_beli', 'harga_jual', 'keterangan'];
   

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function suplier()
    {
        return $this->belongsTo('App\Suplier');
    }

    public function penjualan()
    {
        return $this->hasMany('App\Penjualan');
    }
}
