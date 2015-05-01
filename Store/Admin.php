<?php
/**
 * Description of Admin
 *
 * @author WangChengjin
 */
namespace Store;	

class Admin extends \Core\Lib\ControllerBase
{
    public function index()
    {
    	$res = [];
    	$this->fetch('index.tpl', $res);
    }
}
