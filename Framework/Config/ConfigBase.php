<?php
namespace Core\Config;

class ConfigBase{
    public function __get($name)
    {
        return isset(self::$name) ? self::$name : null;
    }
}