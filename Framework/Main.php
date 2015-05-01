<?php
/**
 * 引导类.
 *
 * @author WangChengjin
 */

namespace Core;

class Main
{
    protected static $instance;
    protected $pathMap = array();
    
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
    
    public function init($map)
    {
        date_default_timezone_set('Asia/Singapore');
        define('SYS_LOG', SYS_ROOT . 'logs' . DIRECTORY_SEPARATOR);
        define('MONITOR_LOG', SYS_LOG . 'monitor' . DIRECTORY_SEPARATOR);
        
        $this->pathMap = $map;
        
        return $this;
    }
    
    public function run()
    {
        $uri = empty($_REQUEST['_rp_']) ? 0 : $_REQUEST['_rp_'];
        
        if (empty($this->pathMap[$uri])) {
            // 当入口路由表中不存在对应值时
            // 调用Dispatcher自动定向已有模块、控制器、及方法 
            $dispatcher = Lib\Dispatcher::instance()->dispatch($uri);
            $route = $dispatcher->route;  
            if(empty($route)){
                // header("Location: /404.html");
            }

            
        }else{
            $route = explode('/', $this->pathMap[$uri]);                                         
        }

        $fun = array_pop($route);
        $class = implode('\\', $route);

        //模组，控制器，ACTION行相关常亮为初始化;
        defined('MOUDLE_NAME')     or define('MOUDLE_NAME'    , $route[0]);                                 //当前模组名
        defined('MODULE_ASSET')    or define('MODULE_ASSET'   , SITE_URL.DS.MOUDLE_NAME."/Template/asset"); //当前模组静态资源地址
        defined('CONTROLLER_NAME') or define('CONTROLLER_NAME', $route[1]);                                 //当前控制器名
        defined('ACTION_NAME')     or define('ACTION_NAME'    , $fun);                                      //当前ACTION    


        if (PHP_SAPI != 'cli') {
            session_start();
        }



        eval($class . '::instance()->' . $fun . '();');
    }

}
