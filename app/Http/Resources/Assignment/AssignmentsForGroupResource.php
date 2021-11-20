<?php

namespace App\Http\Resources\Assignment;

use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentsForGroupResource extends JsonResource
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
            'added_to_group' => $this->pivot->created_at,
            'state' => ['status' => $this->pivot->active ?
                ($this->pivot->finish_date > now() ? 'active' : ($this->pivot->finish_date != null ? 'expired' : 'inactive')) : 'inactive',
                'date' => $this->pivot->active ? (
                    ['start_date' => $this->pivot->start_date,
                        'finis_date' => $this->pivot->finish_date]
                ) : 'date is unset'],
        ];
    }

}
