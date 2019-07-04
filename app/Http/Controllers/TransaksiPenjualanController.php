<?php

namespace App\Http\Controllers;

use App\Nota;
use App\Penjualan;
use App\Http\Resources\NotaResource;
use Illuminate\Http\Request;

class TransaksiPenjualanController extends Controller
{
    public function index()
    {
     
    }

    public function store(Request $request)
    {
        $nota = new Nota;
        $nota->kode = $request->kode;
        $nota->nama_pelanggan = $request->nama_pelanggan;
        $nota->total = $request->total;

       $nota->save();
    
        foreach($request->penjualans as $key => $penjualan){
            $p = new Penjualan;
            $p->barang_id = $penjualan['barang_id'];
            $p->nota_id = $nota->id;
            $p->jumlah = $penjualan['jumlah'];
            $p->sub_total = $penjualan['sub_total'];
            $p->save();
        }


        return new NotaResource($nota);
    }
}
