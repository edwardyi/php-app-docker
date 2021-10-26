<?php

namespace edwardyi\Press;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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

        $this->processFields();
    }

    public function getData()
    {
        return $this->data;
    }

    protected function splitFile()
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s', 
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
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

        $this->data['body'] = trim($this->data[2]);
    }

    protected function processFields()
    {
        /**
         * Date::process($field, $value); // field = date, value = 'May, 14, 1998'
         * return ['date' => Carbon::parse($value)];
         */
        foreach ($this->data as $field => $value)
        {
            // @see https://github.com/illuminate/support/blob/master/Str.php

            $class = 'edwardyi\\Press\\Fields\\'. Str::title($field);
            if (class_exists($class) && method_exists($class, 'process')) {
                $this->data = array_merge(
                    $this->data,
                    $class::process($field, $value)
                );
            }
        }
    }
}