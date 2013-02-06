<?php
/**
 * IndexAction.class.php
 * @copyright			copyright(c)  2013
 * @author alin.chen
 *
 */
class IndexAction extends HomeCommonAction {
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
// 		dump(C());
        dump(__APP__);
		dump(C('TMPL_PARSE_STRING'));
		dump(__ROOT__);
		
		dump($_SERVER);
		dump($_GET);
		echo '========';
		dump($_POST);
		
		dump ( ini_get () );
		
		$array=array(
				1=>"aa",
				2=>"bb",
				3=>"cc",
				);
		dump(array_splice($array, 0,2,"13456789"));
		dump($array);
// 		dump ( $_SERVER );
// 		dump ( $_SERVER ['HTTP_REFERER'] );
// 		dump($array);
// 		$pdo=new PDO($dsn, $username, $passwd, $options)
	}
	public function show() {
		$this->display ();
	}
	
	public function tag() {
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