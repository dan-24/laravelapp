<?php

namespace App\Http\Controllers;

use App\Suplier;
use Illuminate\Http\Request;
use App\Http\Requests\SuplierRequest;
use App\Http\Resources\SuplierResource;


class SuplierController extends Controller
{

    private $suplier;

    function __construct(Suplier $suplier)
    {
        $suplier = $this->suplier;
    }


    public function index()
    {
        return  SuplierResource::collection(Suplier::all());
    }

    public function store(Request $request)
    {
       $suplier = Suplier::create($request->all());

       return new SuplierResource($suplier);

       //return $suplier;
    }

    public function update(SuplierRequest $request, Suplier $suplier)
    {
        $suplier->update($request->all());
        return new SuplierResource($suplier);
    }

    public function destroy(Type $var = null)
    {
        $this->suplier->destroy($id);
    }


}
