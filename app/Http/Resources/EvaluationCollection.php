<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class EvaluationCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // [
        //     'filename' => $this->filename,
        //     'url' => 'http://localhost/rota/public/storage/pdf/'.$this->filename
        // ];
    }
}
