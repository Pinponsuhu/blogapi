<?php

namespace App\Http\Resources;

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
            'id' => (string)$this->id,
                'author'=> $this->author,
                'attributes'=>[
                    'title'=> $this->title,
                    'content'=> $this->content,
                    'created_at'=> $this->created_at,
                ]
        ];
    }
}
