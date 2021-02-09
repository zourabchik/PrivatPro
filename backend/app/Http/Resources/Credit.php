<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class Credit extends JsonResource
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
            'time' => $this->time,
            'rate' => $this->rate,
            'monthly_payment' => $this->monthly_payment,
            'total' => $this->total,
            'createdAt' => Carbon::parse($this->created_at)->format('d.m.Y'),
            'status' => $this->status,
            'confirmation' => $this->confirmation
        ];
    }
}
