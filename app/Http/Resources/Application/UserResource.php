<?php

namespace App\Http\Resources\Application;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
         'id' => $this->id,
         'name' => $this->name??"",
         'email' => $this->email??"",
         'phone' => $this->phone??"",
         'image' => $this->profile??"",
         'dob' => $this->dateofbirth??"",
         'delivery_address' => $this->delivery_address??"",
         'about' => $this->about??"",
         'member_since' => $this->created_at->format('d, M Y'),
        ];
    }
}
