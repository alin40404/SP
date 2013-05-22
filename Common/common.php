<?php

function isHavePower($power){
	$str=getPowerCacheFile();
	if(is_string($str)){
		if(strpos('|'.$str, $power)>0){
			return true;
		}else{
			$descibe="你没有权限操作！";
			$html_str = dialog_toURL($descibe,'window.history.back();','error');
			exit($html_str);
				
		}
	}
}

/**
 * 删除文件夹下面的文件和文件夹
 * @param string $filename
 * @param bool $isRemoveDir  当前文件夹是否删除 ，默认否
 */
function rmdirs($filename,$isRemoveDir=false){
	
	if(strpos($filename,'/')!=0){
		$filename='/'.$filename;
	}
	$filename=trim($filename,'/').'/';
	if(is_dir($filename)){
		$handle=opendir($filename);
		while($file=readdir($handle)){
			if($file!='.'&&$file!='..'){
				$dir=$filename.$file;
				if(is_dir($dir)){
				    rmdirs($dir,true);
				}else{
					unlink($dir);
				}
				
			}
		}
		if($isRemoveDir){
			rmdir($filename);
		}

		closedir($handle);
		
		if($isRemoveDir){
			rmdir($filename);
		}
		
	}else if(file_exists($filename)){
		unlink($filename);
	}
}

function clearCacheFile($dir=''){
	$dirname=(empty($dir))? C('CACHE_FILE_URL'):$dir;
	rmdirs($dirname);
	mkdirs($dirname);
}

function clearLogFile($dir=''){
	$dirname=(empty($dir))? C('LOGS_FILE_URL'):$dir;
	rmdirs($dirname);
	mkdirs($dirname);
}
function clearImgCache($dir=''){
	$dirname=(empty($dir))?C('TEMP_FILE_URL').'img/':$dir;
	rmdirs($dirname);
	mkdirs($dirname);
}

function clearPowerCache($dir=''){
	$power_url=(empty($dir))? C('TEMP_FILE_URL').'power/':$dir;
	$powerFileName=$power_url.md5('admin_'.$_SESSION['adminId']).'.php';
	if(file_exists($powerFileName)){
		unlink($powerFileName);
	}
}
/**
 * 从数据库中获取管理员权限
 * @return mixed
 */
function getPower(){
	$originDB=new OriginModel();
	$adminname = $_SESSION['adminName'];
	$table =  C('DB_PREFIX').'admin';
	$sql = 'SELECT `power` FROM '.$table.' WHERE `adminName`="'.$adminname.'"';
	//exit($sql);
	$result = $originDB->getOneRow($sql);
	$power=$result['power'];
	return $power;
}

/**
 * 获取权限内容
 * @param string $dir
 * @return mixed
 */
function getPowerCacheFile($dir=''){
	$power_url=(empty($dir))?C('TEMP_FILE_URL').'power/':$dir;
	$powerFileName=$power_url.md5('admin_'.$_SESSION['adminId']).'.php';
	if(!file_exists($powerFileName)){
		$power=getPower();
		setPowerCacheFile($power);
		return $power;
	}
	$content=file_get_contents($powerFileName);
	$power=unserialize($content);
	return $power;
}

function setPowerCacheFile($power,$dir=''){
	$power_url=(empty($dir))?C('TEMP_FILE_URL').'power/':$dir;
		
	if(!file_exists($power_url)){
		mkdirs($power_url);
	}
	$powerFileName=$power_url.md5('admin_'.$_SESSION['adminId']).'.php';
	$power=serialize($power);
	return file_put_contents($powerFileName, $power);
	
}



/**
 * 获取IP
 * @return unknown
 */
function getIP(){
	return $_SERVER['REMOTE_ADDR'];
}
/**
 函数名：dialog_toURL
 参数：$message-提示内容,$icon-图标,$reaction-输入后动作,$forTag-，布尔值，是否要<script>标签
 函数作用：指定秒数后执行动作
 返回值：对话框
 **/
function dialog_toURL($message,$reaction,$icon='info.png',$seconds=3,$forTag=true){
	$host=C('APP_ABSOLUTE_PATH');
	$str = '';
	$str = '$.dialog({';
	$str .= 'icon: "'.$icon.'",';
	$str .= 'fixed: true,';
	$str .= 'lock: true,';
	$str .= 'ok: true,';
	$str .= 'content: "'.$message.'",';
	$str .= 'init: function(){var that = this, i = '.$seconds.';var fn = function () {that.title(i + "秒后关闭");!i && that.close();i --;};timer = setInterval(fn, 1000);fn();},';
	$str .= 'close: function(){clearInterval(timer);'.$reaction.'}';
	$str .= '});';
	if($forTag){
		$script=<<<SHOW
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
		<title></title>
		
        <link id="skin_css" href="__PUBLIC__/css/Admin/common_green.css" type="text/css" rel="stylesheet">
	    <link href="__PUBLIC__/css/Admin/admin.index.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/Admin/ico.css" />
		<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
		<script src="__PUBLIC__/js/jquery.cookie.js" type="text/javascript"></script>
	
        <script src="__PUBLIC__/effects/artDialog/jquery.artDialog.min.js?skin=grey" type="text/javascript"></script>
        <script type="text/javascript" src="__PUBLIC__/effects/artDialog/plugins/iframeTools.js"></script>
		<script src="__PUBLIC__/js/Admin/admin.common.js" type="text/javascript"></script>
				
	 <script type="text/javascript">
			(function (config) {
				config['background'] = '#000';
				config['opacity'] = 0.1;
				config['lock'] = true;
				config['fixed'] = true;
				config['okVal'] = '确定';
				config['cancelVal'] = '取消';
			})($.dialog.defaults);
		</script>

       </head>
<body></body>
		<script type="text/javascript">
		__DIALOG__
		</script>
</html>
SHOW;
		$script=str_replace('__PUBLIC__', $host.'Public', $script);
		
		$str =str_replace('__DIALOG__',$str,$script);
	}
	return $str;
}

/**
 * @函数名:getvar
 * @参数:$var——GET或POST传递的变量名称
 * @作用:接收GET或POST传递的变量，并进行基本的安全过滤
 * @返回值:接收到的值
 */
function getvar($var){
	$result = isset($_GET[$var])?@$_GET[$var]:@$_POST[$var];
	if(!is_array($result)){
		if(!get_magic_quotes_gpc())
			$result = addslashes(trim($result));
	}
	return $result;
}
/**
 * 重写URL地址
 * 此方法乃修改Thinkphp内置的U方法
 * @param string $url URL表达式，格式：'[分组/模块/操作]?参数1=值1&参数2=值2...'
 * @param string|array $vars 传入的参数，支持数组和字符串
 * @param string $suffix 伪静态后缀，默认为true表示获取配置值
 * @param boolean $redirect 是否跳转，如果设置为true则表示跳转到该URL地址
 * @param boolean $domain 是否显示域名
 * @return string
 */
function reUrl($url,$vars='', $params = array(), $redirect = false, $suffix = true,$domain=false) {
	// 解析URL
	$info = parse_url ( $url );
	$url = ! empty ( $info ['path'] ) ? $info ['path'] : ACTION_NAME;
	// 解析子域名
	if ($domain === true) {
		$domain = $_SERVER ['HTTP_HOST'];
		if (C ( 'APP_SUB_DOMAIN_DEPLOY' )) { // 开启子域名部署
			$domain = $domain == 'localhost' ? 'localhost' : 'www' . strstr ( $_SERVER ['HTTP_HOST'], '.' );
			// '子域名'=>array('项目[/分组]');
			foreach ( C ( 'APP_SUB_DOMAIN_RULES' ) as $key => $rule ) {
				if (false === strpos ( $key, '*' ) && 0 === strpos ( $url, $rule [0] )) {
					$domain = $key . strstr ( $domain, '.' ); // 生成对应子域名
					$url = substr_replace ( $url, '', 0, strlen ( $rule [0] ) );
					break;
				}
			}
		}
	}

	// 解析参数
	if (is_string ( $vars )) { // aaa=1&bbb=2 转换成数组
		parse_str ( $vars, $vars );
	} elseif (! is_array ( $vars )) {
		$vars = array ();
	}
	if (isset ( $info ['query'] )) { // 解析地址里面参数 合并到vars
		parse_str ( $info ['query'], $params );
		$vars = array_merge ( $params, $vars );
	}

	// URL组装
	$depr = C ( 'URL_PATHINFO_DEPR' );
	if ($url) {
		if (0 === strpos ( $url, '/' )) { // 定义路由
			$route = true;
			$url = substr ( $url, 1 );
			if ('/' != $depr) {
				$url = str_replace ( '/', $depr, $url );
			}
		} else {
			if ('/' != $depr) { // 安全替换
				$url = str_replace ( '/', $depr, $url );
			}
			// 解析分组、模块和操作
			$url = trim ( $url, $depr );
			$path = explode ( $depr, $url );
			$var = array ();
			$var [C ( 'VAR_ACTION' )] = ! empty ( $path ) ? array_pop ( $path ) : ACTION_NAME;
			$var [C ( 'VAR_MODULE' )] = ! empty ( $path ) ? array_pop ( $path ) : MODULE_NAME;
			if (C ( 'URL_CASE_INSENSITIVE' )) {
				$var [C ( 'VAR_MODULE' )] = parse_name ( $var [C ( 'VAR_MODULE' )] );
			}
			if (C ( 'APP_GROUP_LIST' )) {
				$group = ! empty ( $path ) ? array_pop ( $path ) : GROUP_NAME;
				if ($group != C ( 'DEFAULT_GROUP' )) {
					$var [C ( 'VAR_GROUP' )] = $group;
				}
			}
		}
	}

	if (C ( 'URL_MODEL' ) == 0) { // 普通模式URL转换
		// $url = __APP__.'?'.http_build_query($var);
		$url = __ROOT__ . '/index.php?' . http_build_query ( $var );
		if (! empty ( $vars )) {
			$vars = http_build_query ( $vars );
			$url .= '&' . $vars;
		}
	} else { // PATHINFO模式或者兼容URL模式
		if (isset ( $route )) {
			// $url = __APP__.'/'.$url;
			$url = __ROOT__ . '/index.php/' . $url;
		} else {
			// $url = __APP__.'/'.implode($depr,array_reverse($var));
			$url = __ROOT__ . '/' . implode ( $depr, array_reverse ( $var ) );
		}
		if (! empty ( $vars )) { // 添加参数
			$vars = http_build_query ( $vars );
			$url .= $depr . str_replace ( array (
					'=',
					'&'
			), $depr, $vars );
		}
		if ($suffix) {
			$suffix = $suffix === true ? C ( 'URL_HTML_SUFFIX' ) : $suffix;
			if ($suffix) {
				$url .= '.' . ltrim ( $suffix, '.' );
			}
		}
	}
	if ($domain) {
		$url = 'http://' . $domain . $url;
	}
	if ($redirect) // 直接跳转URL
		redirect ( $url );
	else
		return strtolower ( $url );
}

/**
 *
 * 加密解密函数
 * +++++++++++++参数解释++++++++++++++++++
 * $string： 明文 或 密文
 * $operation：DECODE表示解密,其它表示加密
 * $key： 密匙
 * $expiry：密文有效期
 * @return string
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;
	$key = md5 ( $key ? $key : UC_KEY );
	$keya = md5 ( substr ( $key, 0, 16 ) );
	$keyb = md5 ( substr ( $key, 16, 16 ) );
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';

	$cryptkey = $keya . md5 ( $keya . $keyc );
	$key_length = strlen ( $cryptkey );

	$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
	$string_length = strlen ( $string );

	$result = '';
	$box = range ( 0, 255 );

	$rndkey = array ();
	for($i = 0; $i <= 255; $i ++) {
		$rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
	}

	for($j = $i = 0; $i < 256; $i ++) {
		$j = ($j + $box [$i] + $rndkey [$i]) % 256;
		$tmp = $box [$i];
		$box [$i] = $box [$j];
		$box [$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i ++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box [$a]) % 256;
		$tmp = $box [$a];
		$box [$a] = $box [$j];
		$box [$j] = $tmp;
		$result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
	}

	if ($operation == 'DECODE') {
		if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
			return substr ( $result, 26 );
		} else {
			return '';
		}
	} else {
		return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
	}
}


/**
 * 递归对变量中的特殊字符除去转义
 * @param $value
 * @return <multitype:array, string>
 */
function stripslashesDeep($value){
	if(empty($value)){
		return $value;
	}else{
		return is_array($value)?array_map('stripslashesDeep', $value):stripslashes($value);
	}
}

/**
 * 获取扩展的配置数据
 * @return mix
 */
function load_config() {
	$arr = array ();
	$data=F('site_config');
	if($data===false){
		//设置配置数据
	}else{
		$arr=$data;
	}
	return $arr;
}


function showPage($totalRows,$nowPage=1,$perPageRows=5,$rollPages=5){
	if($totalRows<=0){
		//return NULL;
		$totalRows=1;
	}
	$pageAll=array();
	$page=array();
	//总页数
	$totalPages=ceil($totalRows/$perPageRows);
	$page['upName']='';
	$page['up']='up_p_'.($nowPage-1);
	$page['downName']='';
	$page['down']='down_p_'.($nowPage+1);
	if($nowPage<=1){
		$nowPage=1;
	$page['upName']='disabled';
	$page['up']='';
	}
    if($nowPage>=$totalPages){
    	$nowPage=$totalPages;
		$page['downName']='disabled';
		$page['down']='';
	}
	$page['perPageRows']=$perPageRows;
	$page['totalRows']=$totalRows;
	$page['totalPages']=$totalPages;
	$page['nowPage']=$nowPage;
	$pageAll['pgInfo']=$page;
	unset($page);
	$page=array();
	
	$lessPrev=ceil($rollPages/2);
	$moreNext=$totalPages-$lessPrev+1;
	
	if($totalPages<=$rollPages){
		$begin=1;
		$end=$totalPages;
		
	}else{
		if($nowPage>$lessPrev&&$nowPage<$moreNext){
			$begin=$nowPage-$lessPrev+1;;
			$end=$nowPage-$lessPrev+$rollPages;
				
		}else if($nowPage<=$lessPrev){
			$begin=1;
			$end=$rollPages;
			
	}else{
		$begin=$totalPages-$rollPages+1;;
		$end=$totalPages;
		}
	}
	
	for($i=$begin;$i<=$end;$i++){
		if($i!=$nowPage){
			$page[$i]='p_'.$i;
		}else{
			$page[$i]['pid']='p_'.$i;
			$page[$i]['class']='disabled';
		}
	}
	
	$pageAll['pgInfo']['begin']=$begin;
	$pageAll['pgInfo']['end']=$end;
	
	$pageAll['page']=$page;
	return $pageAll;
}

function mkdirs($dir, $mode = 0777)
{
	if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
	if (!mkdirs(dirname($dir), $mode)) return FALSE;
	return @mkdir($dir, $mode);
}