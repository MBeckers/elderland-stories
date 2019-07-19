<?php

namespace Foundation;

class Debugger
{
    protected static $_instance = null;
    public $fps;

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

    public static function fps()
    {
        $self = static::getInstance();

        return $self->fps;
    }
}