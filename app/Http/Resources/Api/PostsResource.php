<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(!empty($this->id)){
            return [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->desc,
            ];
        }
        return parent::toArray($request);
    }
}
