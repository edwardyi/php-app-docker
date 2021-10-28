<?php

namespace edwardyi\Press;

use Carbon\Carbon;
use edwardyi\Press\Facades\Press;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;

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

    /**
     * @var string $rawData
     */
    protected $rawData;

    public function __construct($filename)
    {
        $this->filename = $filename;

        $this->splitFile();

        $this->explodeData();

        $this->processFields();
    }

    public function getRawData()
    {
        return $this->rawData;
    }

    public function getData()
    {
        return $this->data;
    }

    protected function splitFile()
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s', 
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            $this->rawData
        );
    }

    protected function explodeData()
    {
        foreach (explode("\n", trim($this->rawData[1])) as $fieldValue)
        {
            preg_match('/(.*):\s?(.*)/', $fieldValue, $fieldArray);

            $this->data[$fieldArray[1]] = $fieldArray[2];
        }

        $this->data['body'] = trim($this->rawData[2]);
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

            $class = $this->getField(title_case($field));

            if (!class_exists($class) && !method_exists($class, 'process')) {
                $class = 'edwardyi\\Press\\Fields\\Extra';
            }

            $this->data = array_merge(
                $this->data,
                $class::process($field, $value, $this->data)
            );
        }
    }

    /**
     * getField
     * 
     * @var string $field
     * 
     * @return string
     * @throws \ReflectionException
     */
    protected function getField($field)
    {
        // $class = 'edwardyi\\Press\\Fields\\'. Str::title($field);
        foreach (Press::availableFields() as $availableField) {
            $class = new ReflectionClass($availableField);
            if ($class->getShortName() == $field) {
                return $class->getName();
            }
        }
    }
}