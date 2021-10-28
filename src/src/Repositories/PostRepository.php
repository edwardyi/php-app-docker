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
            'extra' => $this->extra($post)
        ]);
    }

    /**
     * extra
     * 
     * @var array $post
     * 
     * @return string
     */
    protected function extra($post)
    {
        // if extra field not exits then use empty array as string
        // $post['extra'] ?? json_encode([])
        $extra = (array) json_decode($post['extra'] ?? '[]');

        $attributes = array_except($extra, ['body', 'title', 'extra', 'identifier']);

        return json_encode(array_merge($extra, $attributes));
    }
}