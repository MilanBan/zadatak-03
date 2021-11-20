<?php

namespace App\Http\Resources\Group;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Intern\ListInternsResource;
use App\Http\Resources\Mentor\ListMentorsResource;
use App\Http\Resources\Assignment\AssignmentResource;

class GroupResource extends JsonResource
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
