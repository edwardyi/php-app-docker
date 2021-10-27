<?php

namespace edwardyi\Press\Console;

use edwardyi\Press\Post;
use edwardyi\Press\Press;
use edwardyi\Press\PressFileParser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        if (Press::configNotPublished()) {
            return $this->warn("Please publish the config file by running\n".
                " php artisan vendor:publish --tag=press-config");
        }

        $posts = Press::driver()->fetchPosts();

        foreach ($posts as $post) {
            // Persist to the DB
            Post::create([
                'identifier' => Str::random(),
                'slug' => Str::slug($post['title']),
                'title' => $post['title'],
                'body' => $post['body'],
                'extra' => $post['extra'] ?? []
            ]);
        }
    }

}