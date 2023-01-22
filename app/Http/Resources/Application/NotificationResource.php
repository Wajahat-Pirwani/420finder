<?php

namespace App\Http\Resources\Application;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = Carbon::parse($this->created_at);
        return [
            'title'=> $this->title??"",
            'description'=> $this->description??"",
            'path'=> $this->path??"",
            'image'=> $this->image??"",
            'type_id'=> $this->type_id??0,
            'notification_type'=> $this->noti_type??"",
            'created_at' => $date->diffForHumans(),
            'status' => $this->status??0
        ];
    }
}
