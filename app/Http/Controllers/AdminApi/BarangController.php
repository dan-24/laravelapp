<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Http\Resources\BarangResource;
use App\Http\Requests\BarangRequest;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    
    public function index()
    {
        return BarangResource::collection(Barang::all());
    }

    public function store(Request $request)
    {
        $suplier = Barang::create($request->all());

        return new BarangResource($suplier);

    }

    public function update(Request $request, Barang $barang)
    {
        $barang->update($request->all());
        return new BarangResource($barang);
    }

    public function destroy(Type $var = null)
    {
        $this->suplier->destroy($id);
    }
}
