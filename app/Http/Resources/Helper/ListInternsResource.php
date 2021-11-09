<?php

namespace App\Http\Resources\Helper;

use Illuminate\Http\Resources\Json\JsonResource;

class ListInternsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ];
    }
}
