<?php

namespace App\Http\Controllers;

use App\Piket;
use App\Http\Resources\GeneralResource;
use Illuminate\Http\Request;

class PiketController extends Controller
{
    public function index()
    {
        return GeneralResource::collection(Piket::all());
    }

    public function store(Request $request)
    {
        $piket = Piket::create($request->all());

        return new GeneralResource($piket);
    }

    public function update(Request $request, Piket $piket)
    {
        $piket->update($request->all());
        return new GeneralResource($piket);
    }
}
