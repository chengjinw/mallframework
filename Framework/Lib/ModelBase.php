<?php
/**
 * ModelBase file.
 * 
 * @author WangChengjin
 */

namespace Core\Lib;

/**
 * Exeptions issued from Models.
 */
class ModelException extends \Exception
{
    
}

/**
 * Abstract model,included commond methods for data access and manipulations for derived classes.
 *
 */
abstract class ModelBase
{
    /**
     *
     * Instances of the derived classes.
     * @var array
     */
    protected static $instances = array();

    /**
     *
     * @var \Db\Connection
     */
    protected static $db;

    /**
     * holds the table's field values which can be accessed via the magic __get, and these fields should be defined in the static $fields property of the derived class.
     *
     * @var array
     */
    protected $fieldProperties = array();

    /**
     * get instance of the derived class
     * @return \Core\Lib\ModelBase
     */
    public static function instance()
    {
        $className = get_called_class();
        if (!isset(self::$instances[$className]))
        {
            self::$instances[$className] = new $className;
        }
        return self::$instances[$className];
    }

    /**
     * magic __get method. You can access the instance of the default DbConnection and field, if filled, values directly.
     *
     * @param string $name
     * @return \Core\Lib\DbConnection|multitype:
     */
    public function __get($name)
    {
        switch ($name)
        {
            case 'db';
                return $this->getDb();
                continue;
            case 'redis':
                return $this->redis();
            default:
                if(isset($this->fieldProperties[$name]))
                {
                    return $this->fieldProperties[$name];
                    continue;
                }
                Log::instance()->log('try get undefined property "'.$name.'" of class '.get_called_class().'. Forgot to call fillFields ?', array('trace_depth' => 2));
                continue;
        }
    }

    /**
     * 获取cache.
     *
     * @param string $endpoint 获取的memcache名字.
     *
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

    /**
     * get a instance of DbConnection of the specified connecton name.
     *
     * @param string $name database configuration name that defined in Config\Db
     * @return \Core\Lib\DbConnection
     */
    public function getDb($name='default')
    {
        if ( ! self::$db || (self::$db instanceof \Core\Lib\DbConnection))
        {
            self::$db = \Core\Lib\DbConnection::instance();
            self::$db->setCfgName($name);
        }
        return self::$db;
    }

    /**
     * 获取平台架构监控日志对象.
     *
     * @param string $app 应用名称.
     *
     * @return mixed
     */
    public function getMNLogger($app)
    {
        static $loggers = array();
        if (!isset($loggers[$app])) {
            $config = Sys::getCfg('MNLogger');
            if (!property_exists($config, $app)) {
                throw new Exception('Missing configuration for `MNLogger::' . $app . '`');
            }
            $loggers[$app] = new \MNLogger\MNLogger($config->$app);
        }
        return $loggers[$app];
    }

    /**
     * fill the table fields with the values. The fields that absent in the $value keys will be filled with null, while the keys which not defined in the $fields property will be ignored.
     *
     * @param array $values  e.g. array('id'=>32, 'user_name' => 'chaos' )
     * @return \Core\Lib\ModelBase  the instance of the calss.array
     * @throws \Core\Lib\ModelException
     */
    public function fillFields(array $values)
    {
        if (!property_exists($this, 'fields') || !is_array($this::$fields))
        {
            throw new ModelException('You cannot call this method, $fields propery is not defined in class '.get_class($this).' or is not an array!');
        }

        $this->fieldProperties = array();

        foreach ($values as $k => $v)
        {
            if (!in_array($k, $this::$fields))
            {
                Log::instance()->log('Try to fill a field "'.$k.'" that is not defined in property "fields" of Model '.get_class($this).'. Is it a typo ?', array('type'=> E_USER_WARNING, 'trace_depth' => 2));
            }
            else
            {
                $this->fieldProperties[$k] = $v;
            }
        }
        return $this;
    }


    /**
     * save record to db.<b>please ensure you're on the correct db connection before you call this method.</b>
     *
     * @param array $fieldValues
     */
    public function save(array $fieldValues = array())
    {
        $this->fillFields($fieldValues);
        if(count($this->fieldProperties) < 1)
        {
            throw new ModelException('Empty fields to save !');
        }
        if(!isset($this->fieldProperties[$this::PRIMARY_KEY]))
        {
            return $this->db->write()->insert($this::TABLE_NAME, $this->fieldProperties);
        }
        else
        {
            return $this->db->write()->update($this::TABLE_NAME, $this->fieldProperties, array($this::PRIMARY_KEY => $this->fieldProperties[$this::PRIMARY_KEY]));
        }
    }
}
