<?php

namespace edwardyi\Press\Drivers;

use edwardyi\Press\PressFileParser;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File as FacadesFile;

class FileDriver extends Driver
{
    /**
     * fetch posts
     * 
     * @return array
     */
    public function fetchPosts()
    {
        $files = FacadesFile::files($this->config);

        // Process each file
        foreach ($files as $file) {
            $this->parse($file, $file->getFilename());
        }

        return $this->posts;
    }

    /**
     * validate source.
     * 
     * @return bool
     */
    protected function validateSource()
    {
        if (!FacadesFile::exists($this->config['path'])) {
            throw new FileNotFoundException(
                'Directory at \''. $this->config['path'] .'\' doest not exist. '.
                'Check the directory path in the config file'
            );
        }
    }
}