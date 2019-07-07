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
        //return NotaResource::collection(Nota::all());
        $nota = Nota::find(3)->penjualan;
        $transaksi = [];
        foreach ($nota as $penjualan) {
            array_push($transaksi, ['penjualan' => $penjualan, 'barang' =>$penjualan->barang]);
        }
        return response()->json($transaksi);
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
