<?php

namespace App\Http\Resources;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            // 'data' =>  ($this->user->required_shifts->where('position_id', $this->position_id)->count() > 1) ? 
            //     $this->user->shifts->random()->start . ' - ' . $this->user->shifts->random()->end : 
            //     \Helper::get_shift($this->user->shifts->where('id', $this->user->required_shifts->where('position_id', $this->position->id)->first()->shift_id)->first())
        ];
    }
}
