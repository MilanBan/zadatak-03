<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Helper\GroupsWithListInternsResource;

class IndexMentorsResource extends JsonResource
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
            'firstName' => $this->user->firstName,
            'lastName' => $this->user->lastName,
            'city' => $this->city,
            'skype' => $this->skype,
            'groups' => GroupsWithListInternsResource::collection($this->groups),
        ];

    }
}
