<?php

namespace App\Http\Resources;

use App\Http\Resources\GroupResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Helper\ListAssignmentsResource;

class ShowInternsResource extends JsonResource
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
        $assignments = $this->group->assignments->filter(function ($item,){
           return data_get($item->pivot, 'active');
        });

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
            'group' => new GroupResource($this->group),
            'assignments' => $assignments ? ListAssignmentsResource::collection($assignments) : 'no assigned assignments',
        ];
    }
}
