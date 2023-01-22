<?php

namespace App\Http\Resources\Application;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = json_decode($this->slide, true);
        return [
            'image' => (string)$images['mobile'],
            'url' => (string)$this->url
        ];
    }
}
