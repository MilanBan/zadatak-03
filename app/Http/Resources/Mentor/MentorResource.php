<?php

namespace App\Http\Resources\Mentor;

use App\Http\Resources\Group\GroupWithListInternsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MentorResource extends JsonResource
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
            'city' => $this->city,
            'skype' => $this->skype,
            'groups' => GroupWithListInternsResource::collection($this->groups),
        ];

    }
}
