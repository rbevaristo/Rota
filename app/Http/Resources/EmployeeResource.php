<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'name' => $this->firstname . " " . $this->lastname,
            'email' => $this->email,
            'username' => $this->username,
            'position' => $this->position->name,
            'profile' => $this->profile,
            'address' => $this->profile->address,
        ];
    }
}
