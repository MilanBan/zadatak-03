<?php

namespace App\Http\Resources\Intern;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateInternResource extends JsonResource
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
            'group_id' => $this->group_id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'city' => $this->city,
            'address' => $this->address,
            'email' => $this->email,
            'cv' => $this->cv,
            'github' => $this->github,
        ];

    }
}
