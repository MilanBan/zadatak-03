<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Helper\GroupsWithInternsResource;

class ShowMentorResource extends JsonResource
{
    public static $wrap = 'mentor';
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
            'groups' => GroupsWithInternsResource::collection($this->groups)
        ];
    }
}
