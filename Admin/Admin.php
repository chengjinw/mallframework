<?php
/**
 * Description of Admin
 *
 * @author WangChengjin
 */

namespace Admin;

class Admin extends \Core\Lib\ControllerBase
{
    public function adminList()
    {
    	$res = [];
    	$this->fetch('index.tpl',$res);
    }
    public function firstPage(){
    	echo "Hello world";
    }
}
