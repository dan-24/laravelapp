<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public function penjualan()
    {
        return $this->hasMany('App\Penjualan');
    }
}
