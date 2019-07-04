<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['piket_id','jabatan_id', 'nama', 'alamat', 'gender', 'no_telphone', 'tgl_lahir', 'pernikahan', 'jumlah_anak'];
    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan');
    }

    public function piket()
    {
        return $this->belongsTo('App\Piket');
    }
}
