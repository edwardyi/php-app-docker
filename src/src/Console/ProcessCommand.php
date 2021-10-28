<?php

namespace edwardyi\Press\Console;

use edwardyi\Press\Exceptions\FileDriverDirectoryNotFoundException;
use edwardyi\Press\Facades\Press;
use edwardyi\Press\Repositories\PostRepository;
use Exception;
use Illuminate\Console\Command;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle(PostRepository $postRepository)
    {
        if (Press::configNotPublished()) {
            return $this->warn("Please publish the config file by running\n".
                " php artisan vendor:publish --tag=press-config");
        }

        try {
            $posts = Press::driver()->fetchPosts();

            $this->info('Total posts:'. count($posts));

            foreach ($posts as $post) {
                // Persist to the DB
                $postRepository->save($post);

                $this->info('Save post:'. $post['title']);
            }
        } catch (Exception $e) {
            throw new FileDriverDirectoryNotFoundException($e->getMessage());
        }
    }

}