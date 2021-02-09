<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Card extends JsonResource
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
            'user' => $this->user,
            'number' => $this->number,
            'currency' => $this->currency,
            'total' => $this->total,
            'name' => $this->number . " (" . $this->total . ")",
        ];
    }
}
