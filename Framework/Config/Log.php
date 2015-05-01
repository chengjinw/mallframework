<?php
/**
 * Log配置
 */
namespace Core\Config;

class Log extends ConfigBase
{
    /**
     * 文件日志的根目录.请确认php进程对此目录可写
     * @var string
     */
    public $FILE_LOG_ROOT = SYS_LOG;

    /**
     * logger is configured to use error_log
     *
     * @var array
     */
    public $default = array(
            'logger' => 'php'
        );

    /**
     * configured to use jsonfile.  fields is require, which indicates how to spplit the log messages
     *
     * @var array
     */
    public $db = array(
        'logger' => 'file',
    );

    public $inventoryLog = array(
        'logger' => 'jsonfile',
        'fields' => array('app', 'sku_no', 'at_time', 'service', 'warehouse', 'company', 'product_id', 'table', 'inventory_onhand', 'inventory_locked', 'inventory_reserved', 'inventory_ordered', 'virtual_fullfillment', 'sellable', 'params', 'return', 'operationid', 'errormsg', 'app_action', 'order_type', 'lot')
    );

    
}
