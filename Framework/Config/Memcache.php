<?php
/**
 * memcache配置
 */
namespace Core\Config;
class memcache extends ConfigBase{
    public $default = array(
            array('host'=>'127.0.0.1', 'port'=>11211),
            array('host'=>'127.0.0.1', 'port' => 11211)
        );
}
