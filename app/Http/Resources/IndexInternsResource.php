<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Helper\GroupWithMentorsResource;

class IndexInternsResource extends JsonResource
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
            'id' =>(string) $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'group' => new GroupWithMentorsResource($this->group),
        ];

    }
}
