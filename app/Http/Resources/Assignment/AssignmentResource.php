<?php

namespace App\Http\Resources\Assignment;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Group\ListGroupsWithAssignmentsResource;

class AssignmentResource extends JsonResource
{
    public static $wrap = 'assignment';
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
            'description' => $this->description,
            'assigned_to_groups' => $this->groups ? ListGroupsWithAssignmentsResource::collection($this->groups) : null,
        ];
    }

}
