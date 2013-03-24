<?php
class UserAction extends AdminCommonAction{

	/**
	 * ----登录模块-----
	 */
	public function login(){
		session_start();
		$lifetime=60*60;
		// 				setcookie();
		// 				session_save_path($savePath);
		// 				session_set_cookie_params($lifetime);
// 		$varname='session.gc_maxlifetime';
// 		ini_set($varname, $lifetime);
		setcookie(session_name(), session_id(), time() + $lifetime, "/");
		
		//$user=array ();
	 	$arrUser=$_POST;
	 	$user=$arrUser['UserName'];
	 	$password=$arrUser['Password'];
	 	$display='none';
		if($_POST){
			//dump($arrUser);
			$userVerified=D('UserVerified');
			//dump($user.$password);
			$field=$userVerified->selectByUnameAndPW($user,$password);
			$field=$field[0];
			//dump($field);
			$isAdmin=$field['isadministrator'];
			if($field!=null&&($isAdmin==='0'||$isAdmin==='1')){
				$_SESSION['user']=$user;
				$_SESSION['isAdmin']=$isAdmin;
				$url='Index/index';
				$this->redirect($url);
			}else{
				$display='block';
				$error='用户名或密码错误！';
				$this->assign('error',$error);
			}
		}
		
			$title='后台登录';
			$this->assign('user',$user);
			$this->assign('title',$title);
			$this->assign('display',$display);
			$this->display();
	}
	
	/**
	 * ----登出-----
	 */
	public function logout(){
// 		unset($_SESSION);
		session_unset();
		session_destroy();
		//$_SESSION['user']='';
		//$_SESSION=null;
		$title='退出成功-后台登出';
		$info='退出成功！';
		$this->assign('title',$title);
		$this->assign('info',$info);
// 		dump($_COOKIE);
// 		dump($_SESSION);
		$this->display();
	}
	
	
}