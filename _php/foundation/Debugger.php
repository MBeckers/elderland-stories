<?php

namespace Foundation;

class Debugger
{
    protected static $_instance = null;
    protected $fps;
    protected $input;
    protected $ms;

    protected function __clone() {}

    protected function __construct() {}

    public static function getInstance()
    {
        if (null === self::$_instance)
        {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    public function setFps(int $fps)
    {
        $this->fps = $fps;
    }
    
    public static function putFps(int $fps)
    {
        $self = static::getInstance();

        $self->setFps($fps);
    }

    public function setInput($input)
    {
        $this->input = $input;
    }

    public static function putInput($input)
    {
        $self = static::getInstance();

        $self->setInput($input);
    }

    public function setUpdateMs(float $ms)
    {
        $this->ms = $ms;
    }

    public static function putUpdateMs(float $ms)
    {
        $self = static::getInstance();

        $self->setUpdateMs($ms);
    }

    public static function fps()
    {
        $self = static::getInstance();

        return $self->fps;
    }

    public static function input()
    {
        $self = static::getInstance();

        return $self->input;
    }

    public static function updateMs()
    {
        $self = static::getInstance();

        return $self->fps;
    }

    public static function memoryUsage()
    {
        return memory_get_usage();
    }

    public static function realMemoryUsage()
    {
        return memory_get_usage( true );
    }
}