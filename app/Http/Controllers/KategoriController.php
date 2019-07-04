<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Http\Resources\BarangResource;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return BarangResource::collection(Kategori::all());

    }

    public function store(Request $request)
    {
        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->keterangan = $request->keterangan;

        $kategori->save();

        return response()->json($kategori);
    }

    public function update(Request $request,  $id)
    {
        $request->validate(['nama_kategori' => 'required']);

        $kategori = Kategori::find($id);
        
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->keterangan = $request->keterangan;
        $kategori->save();
        
        return response()->json($kategori);
    }

    public function destroy($id)
    {
        
    }
}
