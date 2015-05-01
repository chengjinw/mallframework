<?php
/**
 * Description of Home
 *
 * @author WangChengjin
 */

namespace Mall;

class Home extends \Core\Lib\ControllerBase
{
    public function index()
    {
    	$name = $_REQUEST["name"];
    	$sta = $_REQUEST["sta"];
		$arr = array(
			"user" => $name,
			"state" => $sta,
			"phone" => "131111111"
		);
		echo json_encode($arr);
    }
    public function test(){
    	echo "hello test";
    }
}
