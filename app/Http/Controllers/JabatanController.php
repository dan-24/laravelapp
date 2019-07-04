<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use App\Http\Resources\GeneralResource;

class JabatanController extends Controller
{
    public function index()
    {
        return GeneralResource::collection(Jabatan::all());
    }

    public function store(Request $request)
    {
        $jabatan = new Jabatan;
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->keterangan = $request->keterangan;

        $jabatan->save();

        return new GeneralResource($jabatan);
    }

    public function update(Request $request, $d)
    {
        $jabatan = Jabatan::find($id);

        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->keterangan = $request->keterangan;

        $jabatan->save();

        return new GeneralResource($jabatan);

    }
}
