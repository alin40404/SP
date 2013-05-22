<?php
/**
 * IndexAction.class.php
 * @copyright			copyright(c)  2013
 * @author alin.chen
 *
 */
class IndexAction extends HomeCommonAction {
	/**
	 * 默认
	 */
	public function index() {
		
		$title='SP-首页';
		$this->assign('title',$title);
		$this->display ();
	}
	
	public function show() {

// 		header ( "Content-Type:text/html; charset=utf-8" );
// 		echo '<div style="font-weight:normal;color:blue;float:left;width:345px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;font-size:14px;font-family:Tahoma">^_^ Hello,欢迎使用<span style="font-weight:bold;color:red">ThinkPHP</span></div>';
// 		dump ( rtrim ( dirname ( __FILE__ ), '/\\' ) );
// 		dump ( dirname ( __FILE__ ) );
// 		$config = require ("D:\\AppServ\\www\\SP/Conf/db_config.php");
// 		$array = require ("D:\\AppServ\\www\\SP/Conf/config.php");
// 		$config [] = 'alin';
		$this->display();
		
	}
	
	public function tag() {
		$this->display ();
	}
	
	public function test(){
		$this->display ();
	}
	
	public function xss(){
		$content=<<<SHOW
		 <!DOCTYPE html>
				<html>
	<head>
				 <meta http-equiv=Content-Type content="text/html; charset=utf-8"> 
				<title>xss攻击</title>
				</head>
<body> 
<form action="" method="GET"> 
<!-- 我使用的GET方法,因为当我们利用的时候更容易练习. --> 
Script: <input name="name" type="text"> 
<input type="submit" value="submit"> 
</form> 
</body> 
</html> 
SHOW;
		echo $content;
		if($_GET){
		$name = $_GET['name'];
		echo("Hello $name");
		}
	}
	
	public function sql(){
		$content=<<<SHOW
		<html> 
<body> 
<form action="" method="POST"> 
Username: <input name="name" type="name"> 
Password: <input name="password" type="password"> 
<input type="submit" type="submit" value="Submit"> 
</form> 
</body> 
</html> 
SHOW;
		echo $content;
	}
	
	public function _empty(){
		$content=<<<SHOW
<h2>404</h2>
SHOW;
		echo $content;
	}
	
}