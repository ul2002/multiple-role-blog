<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollectiion extends ResourceCollection
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
            'items' => $this->collection->transform(function($post){
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'description' => $post->description,
                    'owner' => new User($post->user),
                    'created_at' => date($post->created_at)
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
