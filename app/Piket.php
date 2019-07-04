<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piket extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['kode', 'jam_masuk', 'jam_pulang', 'hari_masuk', 'keterangan'];
    
    public function pegawai()
    {
        return $this->hasMany('App\Pegawai');
    }

}
