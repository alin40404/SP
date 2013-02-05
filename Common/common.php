<?php

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