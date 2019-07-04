<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $defaultData =  parent::toArray($request);

        $additionalData = [
            'suplier'=> $this->kategori,
            'kategori'=> $this->suplier,
          ];
        
        return array_merge($defaultData, $additionalData);
    }
}
