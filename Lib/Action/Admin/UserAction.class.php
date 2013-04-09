<?php
class UserAction extends AdminCommonAction {
	
	/**
	 * ----登录模块-----
	 */
	public function login() {
		session_start ();
		$lifetime = 60 * 60;
		// setcookie();
		// session_save_path($savePath);
		// session_set_cookie_params($lifetime);
		// $varname='session.gc_maxlifetime';
		// ini_set($varname, $lifetime);
		setcookie ( session_name (), session_id (), time () + $lifetime, "/" );
		
		// $user=array ();
		$arrUser = $_POST;
		$user = $arrUser ['UserName'];
		$password = $arrUser ['Password'];
		$display = 'none';
		if ($_POST) {
			// dump($arrUser);
			$userVerified = D ( 'UserVerified' );
			// dump($user.$password);
			$field = $userVerified->selectByUnameAndPW ( $user, $password );
			$field = $field [0];
			// dump($field);
			$isAdmin = $field ['isadministrator'];
			if ($field != null && ($isAdmin === '0' || $isAdmin === '1')) {
				$_SESSION ['user'] = $user;
				$_SESSION ['isAdmin'] = $isAdmin;
				$url = 'Index/index';
				$this->redirect ( $url );
			} else {
				$display = 'block';
				$error = '用户名或密码错误！';
				$this->assign ( 'error', $error );
			}
		}
		
		$title = '后台登录';
		$this->assign ( 'user', $user );
		$this->assign ( 'title', $title );
		$this->assign ( 'display', $display );
		$this->display ();
	}
	
	/**
	 * ----登出-----
	 */
	public function logout() {
		// unset($_SESSION);
		session_unset ();
		session_destroy ();
		// $_SESSION['user']='';
		// $_SESSION=null;
		$title = '退出成功-后台登出';
		$info = '退出成功！';
		$this->assign ( 'title', $title );
		$this->assign ( 'info', $info );
		// dump($_COOKIE);
		// dump($_SESSION);
		
		$str = "aaa阿s凡d达奋斗ad";
		dump(strrev($str));
		dump(mb_substr($str, 0,9,'utf-8'));
		dump(mb_strcut($str, 0,9,'utf-8'));
		$len = strlen ( "a阿" );
		dump ( $len );
		for($i = 0; $i < $len; $i ++) {
			echo $str [$i] . ' ';
		}
		// $this->display();
		$path = "D:/AppServ/www/SP";
		$files = $this->my_scandir ( $path );
		dump ( $files );
// 		$obj=new DOMDocument('1.0', 'utf-8');
// 		$reader=new XMLReader();
			
	}
	
	public function test(){
	  dump(is_null($var));
	  dump(0=="1php");
	  dump(0=="23");
	  
	  
// 	  $array=range(1,100,4);
// 		//dump($array);	
// 		shuffle($array);
// 		dump($array);
// 		echo "----insert sort----","<br />";
// 		dump($this->insert_sort($array));
// 		echo "----choose sort----","<br />";
		
// 		dump($this->choose_sort($array));
// 		echo "----quick sort----","<br />";
		
// 		dump($this->quick_sort($array));
// 		echo "----bubble sort----","<br />";
		
// 		dump($this->bubble_sort($array));
// 		echo "--------------------","<br />";
// 		$$array=range(2, 50,2.9);
// 		dump($$array);
// 		echo isset($$$array);
// 		print(empty($$$array));
	$result= $this->getRelativePath('/a/b/c/d/e.php', '/a/b/c/d/12/34/c.php');
	dump($result);
	
	dump($_SERVER);
	
	$path="/a/b/c.db.php";
	dump(pathinfo($path));
	}
	
	private function getRelativePath($a,$b){
		$arrA=explode('/',$a);
		$arrB=explode('/',$b);
		$countA=count($arrA);
		$countB=count($arrB);
		for($i=0;$i<$countA;$i++){
			if($arrA[$i]!=$arrB[$i]){
				break;
			}
		}
		//dump($countA.','.$i);
		if($countA>$i+1){
			$returnPath=array_fill(0, $countA-$i-1, '..');
		}else{
			$returnPath=array('.');
		}
		$returnPath=array_merge($returnPath,array_slice($arrB, $i));
		return implode('/', $returnPath);
		
	}
	
	private function my_scandir($path) {
		$files = array ();
		if ($handle = opendir ( $path )) {
			while ( ($file = readdir ( $handle )) !== false ) {
				dump ( $file );
				if ($file != ".." && $file != ".") {
					if (is_dir ( $file )) {
						$files [$file] = scandir ( $path . '/' . $file );
					} else {
						$files [] = $file;
					}
				}
			}
		}
		closedir ( $handle );
		return $files;
	}
	/**
	 * 插入排序
	 * @param unknown_type $array
	 * @return unknown
	 */
	private function insert_sort($array){
		if(!is_array($array)){
			return $array;
		}
		$count=count($array);
		for($i=1;$i<$count;$i++){
			for($j=$i;$j>0;$j--){
				if($array[$j]<$array[$j-1]){
					$temp=$array[$j];
					$array[$j]=$array[$j-1];
					$array[$j-1]=$temp;
				}
			}
		}
		return $array;
	}
	
	/**
	 * 选择排序
	 * @param unknown_type $array
	 * @return unknown
	 */
	private function choose_sort($array){
		if(!is_array($array)){
			return $array;
		}
		$count=count($array);
		for($i=0;$i<$count-1;$i++){
			$min=$i;
			for($j=$i+1;$j<$count;$j++){
				if($array[$min]>$array[$j]){
					$min=$j;
				}
			}
			if($min!=$i){
				$temp=$array[$min];
				$array[$min]=$array[$i];
				$array[$i]=$temp;
			}
		}
		return $array;
	}
	/**
	 * 快速排序
	 * @param unknown_type $array
	 * @return unknown|multitype:
	 */
	private function quick_sort($array){
		$count=count($array);
		if($count<=1) return $array;
		$key=$array[0];
		$left_arr=array();
		$right_arr=array();
		for($i=1;$i<$count;$i++){
			if($array[$i]<=$key){
				$left_arr[]=$array[$i];
			}else{
				$right_arr[]=$array[$i];
			}
		}
		$left_arr=$this->quick_sort($left_arr);
		$right_arr= $this->quick_sort($right_arr);
		return array_merge($left_arr,array($key),$right_arr);
	}
	/**
	 * 冒泡排序 
	 * @param unknown_type $array
	 * @return unknown
	 */
	private function bubble_sort($array){
		if(!is_array($array))return $array;
		$count=count($array);
		for($i=0;$i<$count-1;$i++){
			for($j=$count-1;$j>$i;$j--){
				if($array[$j]<$array[$j-1]){
					$temp=$array[$j];
					$array[$j]=$array[$j-1];
					$array[$j-1]=$temp;
				}
			}
		}
		//$array[j]=10000;
		return $array;
	}
}