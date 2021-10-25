<?php

namespace edwardyi\Press;

use Illuminate\Support\Facades\File;

class PressFileParser
{
    /**
     * @var string $filename
     */
    protected $filename;

    /**
     * @var string $data
     */
    protected $data;

    public function __construct($filename)
    {
        $this->filename = $filename;

        $this->splitFile();
    }

    public function getData()
    {
        return $this->data;
    }

    private function splitFile()
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s', 
            File::get($this->filename), 
            $this->data
        );
    }
}