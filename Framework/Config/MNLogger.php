<?php
namespace Core\Config;

class MNLogger extends ConfigBase
{

    public $exception = array(
        'on' => true,
        'app' => 'payment',
        'logdir' => MONITOR_LOG,
    );
    
    public $trace = array(
        'on' => true,
        'app' => 'wom',
        'logdir' => MONITOR_LOG,
    );

    public $users = array(
        'on' => true,
        'app' => 'users',
        'logdir' => SYS_LOG,
    );
}

