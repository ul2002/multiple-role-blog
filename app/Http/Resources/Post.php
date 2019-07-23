<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;


class Post extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'owner' => new User($this->user),
            'created_at' => date($this->created_at)
        ];
    }
}
