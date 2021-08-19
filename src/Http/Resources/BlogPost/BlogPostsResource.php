<?php

namespace BCleverly\Backend\Http\Resources\BlogPost;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogPostsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
