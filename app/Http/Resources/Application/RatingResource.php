<?php

namespace App\Http\Resources\Application;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->customer_id??0,
            'name' => $this->user->name??"",
            'image' => $this->user->profile ?? "",
            'description' => $this->description ?? "",
            'rating' => (double)$this->rating??0,
            'date' => $this->created_at->diffForHumans(),
        ];
    }
}
