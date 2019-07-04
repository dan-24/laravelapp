<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    public function nota()
    {
        return $this->belongsTo('App\Nota');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }

    public function nama_barang()
    {
        return $this->hasManyThrough('App\Nota', 'App\Barang');
    }
}
