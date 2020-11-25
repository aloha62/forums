<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Comments as CommentResource;
use App\Comments;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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
            'comments' => CommentResource::collection(Comments::where('is_published', true)->take(5)->get()),
            'comment_count' => Comments::where('post_id', $this->id)->count()
        ];
    }
}
