<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Helper\ListMentorsResource;

class ReviewsForInternResource extends JsonResource
{
    public static $wrap = 'review';
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
            'mark' => $this->mark,
            'pros' => $this->pros,
            'cons' => $this->cons,
            'mentor' => [
                'id' => $this->mentor->id,
                'fullName' => $this->mentor->user->firstName.' '.$this->mentor->user->lastName,
            ],
            'assignment' => [
                'id' => $this->assignment->id,
                'name' => $this->assignment->name,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
