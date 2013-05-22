<?php
class UserAction extends AdminCommonAction {
	
	/**
	 * ----登录模块-----
	 */
	public function login() {
		session_start ();
		$lifetime = 60 * 60*60;
		setcookie ( session_name (), session_id (), time () + $lifetime, "/" );
		
		$display = 'none';
		$adminName=$_SESSION ['adminName'] ;
		
		if(isset($adminName)&&!empty($adminName)){
// 			$url = 'Index/index';
// 			$this->redirect ( $url );
			$descibe="登录成功！";
			exit(dialog_toURL($descibe,'window.history.back();','succeed'));
				
		}

		
		$title = '后台登录';
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
		// $_SESSION['adminName']='';
		// $_SESSION=null;
		$title = '退出成功-后台登出';
		$info = '退出成功！';
		$href=C('HOST').'g=Admin&m=User&a=login';
		$this->assign ( 'title', $title );
		$this->assign ( 'info', $info );
		$this->assign('href',$href);
		$this->display();
			
	}
	

}