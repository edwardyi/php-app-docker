<?php

namespace edwardyi\Press\Repositories;

use edwardyi\Press\Post;
use Illuminate\Support\Str;

class PostRepository
{
    /**
     * save
     * 
     * @var array $post
     * 
     * @return void
     */
    public function save($post)
    {
        Post::updateOrCreate([
            'identifier' => $post['identifier'],
        ],[
            'slug' => Str::slug($post['title']),
            'title' => $post['title'],
            'body' => $post['body'],
            'extra' => $post['extra'] ?? json_encode([])
        ]);
    }
}