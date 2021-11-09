<?php

namespace App\Http\Resources\Helper;

use App\Http\Resources\Helper\ListInternsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupsWithListInternsResource extends JsonResource
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
            'name' => $this->name,
            'interns' => ListInternsResource::collection($this->interns)
        ];
    }
}
