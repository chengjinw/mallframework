<?php
/**
 * 框架便捷方法及公用函数
 * 
 **/


/*
 * 获取用户IP地址
 * 
 * 
 * */
function getIP(){
	global $ip;

	if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP");
	else if(getenv("HTTP_X_FORWARDED_FOR"))$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if(getenv("REMOTE_ADDR"))$ip = getenv("REMOTE_ADDR");else$ip = "Unknow";

	return $ip;
}

/**
 * 数组进行自动扩张到指定数量
 * @param $resouce_arr array 原型数组 <p>
 * @param $num int 需填充到的指定数量 <p>
 * 
 **/
function array_fill_byself($resouce_arr,$num){
	$arr_cnt = count($resouce_arr);
		if ($arr_cnt!=$num){
			for($i=$arr_cnt;$i<$num;$i++){
				$resouce_arr[$i] = $resouce_arr[0]; 
			}
		}
	return $resouce_arr;
}

/**
 * 判断请求来源是否为AJAX
 * 
 */
function IS_AJAX(){
	if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){ 
		return true;
	}else{ 
	    return false;
	};
}

/*
 * 获取格式化后的本地时间 
 * 
 * */

function localdate(){
	date_default_timezone_set('PRC');
	$date = date("Y-m-d H:i:s");
	return $date;
}
/**
 * 递归复制目录
 *
 */	

function re_copy($src,$dst) {  // 原目录，复制到的目录

    $dir = opendir($src);
    if(!is_dir($dst)){mkdir($dst);}
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                re_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}


/**
 * 模型调用便捷方法
 * @param model_name string 模型名<p>
 *
 */

if (!function_exists('Model')) {
    function Model($model_name) {
    	$model_name = ucfirst(strtolower($model_name));
    	$Model = '\\Model\\'.$model_name;
    	
    	return new $Model;
    }
}


/**
 *  数组递归过滤函数 for htmlspecialchars
 *
 */	
function array_htmlsp(&$arr){

	foreach ($arr as $key => $val ){
		if (is_array ($val)) {
			arr_foreach($arr[$key]);
		}else{
			$arr[$key] = htmlspecialchars($arr[$key]);
		}
	}

	return $arr;
}


/**
 *  获取各种输入变量，及自动过滤输入 
 *
 */
function filter($name,$default='',$filter=null,$datas=null) {
    if(strpos($name,'.')) { // 指定参数来源
        list($method,$name) =   explode('.',$name,2);
    }else{ // 默认为自动判断
        $method =   'param';
    }
    switch(strtolower($method)) {
        case 'get'     :   $input =& $_GET;break;
        case 'post'    :   $input =& $_POST;break;
        case 'put'     :   parse_str(file_get_contents('php://input'), $input);break;
        case 'param'   :
            switch($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $input  =  $_POST;
                    break;
                case 'PUT':
                    parse_str(file_get_contents('php://input'), $input);
                    break;
                default:
                    $input  =  $_GET;
            }
            break;
        case 'request' :   $input =& $_REQUEST;   break;
        case 'session' :   $input =& $_SESSION;   break;
        case 'cookie'  :   $input =& $_COOKIE;    break;
        case 'server'  :   $input =& $_SERVER;    break;
        case 'globals' :   $input =& $GLOBALS;    break;
        case 'data'    :   $input =& $datas;      break;
        default:
            return NULL;
    }
    if(''==$name) { // 获取全部变量
        $data       =   $input;
        array_walk_recursive($data,'filter_exp');
        $filters    =   isset($filter)?$filter:DEFAULT_FILTER;
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }
            foreach($filters as $filter){
                $data   =   array_map_recursive($filter,$data); // 参数过滤
            }
        }
    }elseif(isset($input[$name])) { // 取值操作
        $data       =   $input[$name];
        is_array($data) && array_walk_recursive($data,'filter_exp');
        $filters    =   isset($filter)?$filter:DEFAULT_FILTER;
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }elseif(is_int($filters)){
                $filters    =   array($filters);
            }
            
            foreach($filters as $filter){
                if(function_exists($filter)) {
                    $data   =   is_array($data)?array_map_recursive($filter,$data):$filter($data); // 参数过滤
                }else{
                    $data   =   filter_var($data,is_int($filter)?$filter:filter_id($filter));
                    if(false === $data) {
                        return   isset($default)?$default:NULL;
                    }
                }
            }
        }
    }else{ // 变量默认值
        $data = isset($default)?$default:NULL;
    }
    return $data;
}

?>