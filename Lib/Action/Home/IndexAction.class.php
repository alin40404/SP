<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function index() {
		header ( "Content-Type:text/html; charset=utf-8" );
		echo '<div style="font-weight:normal;color:blue;float:left;width:345px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;font-size:14px;font-family:Tahoma">^_^ Hello,欢迎使用<span style="font-weight:bold;color:red">ThinkPHP</span></div>';
		dump ( rtrim ( dirname ( __FILE__ ), '/\\' ) );
		dump ( dirname ( __FILE__ ) );
		$config = require ("D:\\AppServ\\www\\SP/Conf/db_config.php");
		$array = require ("D:\\AppServ\\www\\SP/Conf/config.php");
		$config [] = 'alin';
		// dump($config);
		
		// dump($array);
		
		// $url='http://www.baidu.com/';
		// $file=file($url);
		
		// dump($file);
		
		// global $g;
		// $g='hellworld';
		// function test(){
		// global $g;
		// dump($g);
		// }
		// test();
		echo (__NAMESPACE__);
		dump ( ini_get () );
		
		dump ( $_SERVER );
		dump ( $_SERVER ['HTTP_REFERER'] );
	}
	public function show() {
		$this->display ();
	}
	public function tag() {
		$this->display ();
	}
}