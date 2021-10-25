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

        $this->explodeData();
    }

    public function getData()
    {
        return $this->data;
    }

    protected function splitFile()
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s', 
            File::get($this->filename), 
            $this->data
        );
    }

    protected function explodeData()
    {
        foreach (explode("\n", trim($this->data[1])) as $fieldValue)
        {
            preg_match('/(.*):\s?(.*)/', $fieldValue, $fieldArray);

            $this->data[$fieldArray[1]] = $fieldArray[2];
        }
    }
}