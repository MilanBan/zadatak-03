<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InternsResource extends JsonResource
{
    public static $wrap = 'intern';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>(string) $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'city' => $this->city,
            'address' => $this->address,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'cv' => $this->cv,
            'github' => $this->github,
        ];
    }
}
