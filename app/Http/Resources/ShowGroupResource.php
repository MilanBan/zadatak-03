<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Helper\ListInternsResource;
use App\Http\Resources\Helper\ListMentorsResource;

class ShowGroupResource extends JsonResource
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
            'mentors' => ListMentorsResource::collection($this->mentors),
            'interns' => ListInternsResource::collection($this->interns),
            'assignments' => AssignmentResource::collection($this->assignments) 
        ];
    }
}
