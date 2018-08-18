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
            'id' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'position' => $this->position->name,
        ];
    }
}
