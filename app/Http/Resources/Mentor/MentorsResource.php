<?php

namespace App\Http\Resources\Mentor;

use App\Http\Resources\Group\ListGroupsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MentorsResource extends JsonResource
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
            'id' => (string) $this->id,
            'firstName' => $this->user->firstName,
            'lastName' => $this->user->lastName,
            'groups' => ListGroupsResource::collection($this->groups),
        ];

    }
}
