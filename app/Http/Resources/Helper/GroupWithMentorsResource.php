<?php

namespace App\Http\Resources\Helper;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Helper\ListMentorsResource;

class GroupWithMentorsResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'mentors' => ListMentorsResource::collection($this->mentors),
        ];
    }
}
