<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'id' => $this->id,
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'avatar' => 'http://localhost:8000/storage/avatar/'.$this->profile->avatar,
            'gender' => $this->gender($this->profile->gender),
            'birthdate' => $this->profile->birthdate,
            'mobile' => $this->profile->contact,
            'number' => $this->profile->address->number,
            'street' => $this->profile->address->street,
            'city' => $this->profile->address->city,
            'state' => $this->profile->address->state,
            'zip' => $this->profile->address->zip,
            'country' => $this->profile->address->country,
        ];
    }

    public function gender($gender)
    {
        if($gender == null)
            return '';
        if($gender)
            return 'Male';
        else
            return 'Female';
    }
}
