<?php

namespace App\Http\Resources\Intern;

use App\Http\Resources\Group\ListGroupsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Review\ReviewsForInternResource;
use App\Http\Resources\Assignment\AssignmentWithReviewsResource;
use App\Http\Resources\Group\GroupWithAssignmentsForInternResource;

class InternResource extends JsonResource
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
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'city' => $this->city,
            'address' => $this->address,
            'email' => $this->email,
            'cv' => $this->cv,
            'github' => $this->github,
            'group' => $this->group ? new GroupWithAssignmentsForInternResource($this->group): null,
            'reviews' => $this->reviews ? ReviewsForInternResource::collection($this->reviews): null,
        ];

    }
}
