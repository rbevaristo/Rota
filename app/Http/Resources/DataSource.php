<?php

namespace App\Http\Resources;

use App\Employee;
use App\EvaluationResult;
use Illuminate\Http\Resources\Json\JsonResource;

class DataSource extends JsonResource
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
            'user' => $this,
            'company' => $this->company,
        ];
    }
}
