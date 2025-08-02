<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image' => asset('storage/' . $this->image),
            'category' => $this->category,
            'tag' => $this->tag,
            'embeded_video' => $this->embeded_video,
            'status' => $this->status,
            'popularity' => $this->popularity,
        ];
    }
}
