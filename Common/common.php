<?php


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