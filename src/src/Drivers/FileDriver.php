<?php

namespace edwardyi\Press\Drivers;

use edwardyi\Press\PressFileParser;
use Illuminate\Support\Facades\File as FacadesFile;

class FileDriver
{
    public function fetchPosts()
    {
        $files = FacadesFile::files(config('press.path'));

        // Process each file
        foreach ($files as $file) {
            $posts[] = (new PressFileParser($file->getPathname()))->getData();
        }

        return $posts ?? [];
    }
}