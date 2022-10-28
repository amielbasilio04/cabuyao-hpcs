<?php

namespace App\Http\Resources\User\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'post' => $this->post,
            'image' => $this->getFirstMedia('post_images')?->getUrl('card'),
            'category' => $this->category,
            'created_at' => $this->created_at
        ];
    }
}
