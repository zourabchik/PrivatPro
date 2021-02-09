<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class User extends JsonResource
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
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'middleName' => $this->middle_name,
            'fullName' => $this->first_name . ' ' . $this->last_name . ' ' . $this->middle_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'birth' => Carbon::parse($this->birth)->format('d.m.Y'),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'roles' => $this->roles ? Role::collection($this->roles) : []
        ];
    }
}
