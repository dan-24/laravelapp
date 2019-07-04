<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $defaultdata = parent::toArray($request);
        $additionaldata = [
            'permissions' => $this->permissions
        ];

        return array_merge($defaultdata, $additionaldata);

    }
}
