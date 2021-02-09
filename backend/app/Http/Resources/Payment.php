<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class Payment extends JsonResource
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
            'fromCard' => $this->fromCard,
            'toCard' => $this->toCard,
            'description' => $this->description,
            'status' => $this->status,
            'total' => $this->total,
            'createdAt' => Carbon::parse($this->created_at)->format('d.m.Y'),
            'confirmation' => $this->confirmation
        ];
    }
}
