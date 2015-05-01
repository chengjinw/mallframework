<?php
/**
 * Description of Smarty
 *
 * @author WangChengjin
 */

namespace Core\Config;

class Smarty extends ConfigBase
{

    public $caching = false;
    public $compile_dir = 'Temp/Compile/';
    public $cache_dir = 'Temp/Cache/'; 
    public $template_dir = array(
        'Mall' => 'D:/www/womall-new/Mall/Template/',
        'Admin' => 'D:/www/womall-new/Admin/Template/',
        'Store' => 'D:/www/womall-new/Store/Template/'
    );
    
}
