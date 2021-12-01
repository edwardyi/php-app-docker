<?php

namespace edwardyi\Press\Drivers;

use edwardyi\Press\PressFileParser;

abstract class Driver
{
    /**
     * @var array $posts
     */
    protected $posts = [];

    /**
     * @var array $config
     */
    protected $config;

    public function __construct()
    {
        $this->setConfig();

        $this->validateSource();
    }

    public abstract function fetchPosts();

    /**
     * set config when construct abstract object
     * 
     * @return void
     */
    protected function setConfig()
    {
        $this->config = config('press.'.config('press.driver'));
    }

    /**
     * @var string $content
     * @var string $identifier
     * 
     * @return void
     */
    protected function parse($content, $identifier)
    {
        $this->posts[] = array_merge(
            (new PressFileParser($content))->getData(), 
            ['identifier' => $identifier]
        );
    }

    /**
     * validate source.
     * 
     * @return bool
     */
    protected function validateSource()
    {
        return true;
    }
}