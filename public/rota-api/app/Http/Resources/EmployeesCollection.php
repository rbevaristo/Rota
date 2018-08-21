<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class EmployeesCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
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
            'status' => $this->status,
            'position' => $this->position->name,
            'avatar' => 'http://localhost:8000/storage/avatar/'.$this->profile->avatar,
            'gender' => $this->gender($this->profile->gender),
            'birthdate' => $this->profile->birthdate,
            'contact' => $this->profile->contact,
            'address' => $this->profile->address->number . ', ' . $this->profile->address->street . ', ' . $this->profile->address->city . ', ' . $this->profile->address->state . ', ' . $this->profile->address->zip . ', ' . $this->profile->address->country,
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