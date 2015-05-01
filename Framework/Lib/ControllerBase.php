<?php
/**
 * Description of ControllerBase
 *
 * @author Chengjin Wang
 */

namespace Core\Lib;

class ControllerBase {
    
    protected static $instance;
    
    /**
     *
     * @return self
     */
    public static function instance()
    {
        if(!static::$instance)
        {
            static::$instance = new static;
        }
        return static::$instance;
    }
    
    public function fetch($templateFile, $var)
    {
        $classPath = str_replace('\\', DIRECTORY_SEPARATOR, get_called_class());
        $portion = explode(DIRECTORY_SEPARATOR, $classPath);
        array_pop($portion);
        $namespaceDir = implode('\\', $portion);
        return \Core\Lib\Smarty::instance()->fetch($templateFile, $var, $namespaceDir);
    }
    
    /**
     * get a memcache instance
     * @return \Core\Lib\Memcache
     */
    public function cache($endpoint = 'default')
    {
        return \Core\Lib\MemcachePool::instance($endpoint);
    }

    /**
     * Get a redis instance.
     * @param string $endpoint connection configruation name.
     * @param string $as use redis as "cache" or storage. default: storage
     * @return \RedisCache|\RedisStorage
     */
    public function redis($endpoint = 'default', $as='storage')
    {
        return \Core\Lib\RedisDistributed::instance($endpoint, $as);
    }

    public function __get($name)
    {
        switch ($name)
        {
            case 'redis':
                return $this->redis();
            case 'cache':
                return $this->cache();
            default:
                trigger_error('try get undefined property: '.$name.' of class '.__CLASS__, E_USER_NOTICE);
                continue;
        }
    }
    
}
