<?php

namespace Core\Lib;



/**
 * 内置的Dispatcher类
 * 完成URL解析、路由和调度
 */

class Dispatcher {

    protected static $instance;
    var $route;
    var $fun;

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

    /**
     * URL映射到控制器
     * @access public
     * @return void
     */
    public function dispatch($uri = null) {
        if(is_string($uri)){
            $uri = strpos($uri,'/') === 0 ? substr($uri,1):$uri;
            $route_arr = explode('/', $uri);
            switch (count($route_arr)) {
                case 0:
                    # code...
                    break;
                case 1:
                    # code...
                    break;
                case 2:
                    $this->route = array_slice($route_arr,0,2);
                    $this->route[] = 'index';
                    break;                                    
                default:
                    $this->route = array_slice($route_arr,0,3);
                    break;
            }
    
        }

        return $this;
    }

}
