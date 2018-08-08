<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Billboard extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'city'        => $this->city,
            'address'     => $this->address,
            'description' => $this->description,
            'coordinates' => $this->coordinates,
            'coordinateX' => json_decode($this->coordinates)[0],
            'coordinateY' => json_decode($this->coordinates)[1],
            'created_at'  => (string) $this->created_at,
            'updated_at'  => (string) $this->updated_at
        ];
    }
}
