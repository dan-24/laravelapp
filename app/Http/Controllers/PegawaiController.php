<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Http\Resources\GeneralResource;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return GeneralResource::collection(Pegawai::all());
    }

    public function store(Request $request)
    {
        $pegawai = Pegawai::create($request->all());
      
    }
}
