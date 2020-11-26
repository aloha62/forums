<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Comments;
use App\Http\Resources\Comments as CommentResource;

class Posts extends JsonResource
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
            'slug' => $this->slug,
            'content' => $this->content,
            'comment_count' => Comments::where('post_id', $this->id)->count(),
            'comments' => CommentResource::collection(Comments::where('is_published', true)->take(5)->get()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
