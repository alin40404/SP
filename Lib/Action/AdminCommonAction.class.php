<?php
class AdminCommonAction extends CommonAction{
	
	protected $_user = null;
	protected $pageNum=5;
	protected $rollPages=5;
	protected function _initialize() {
		parent::_initialize ();
		// 禁止通过URL访问的操作
		if (in_array ( MODULE_NAME . '.' . strtolower ( ACTION_NAME ), C ( 'APP_ACTION_DENY_LIST' ) )) {
			die ( '抱歉,您没权限访问该模块!' );
		}
	
		if (intval ( $this->_siteConfig ['url_rewrite'] ) == 1) {
			C ( 'URL_MODEL', 2 );
		} else {
			C ( 'URL_MODEL', 0 );
		}
	
		// 初始化用户信息
		$this->_init_user ();
		// 验证登陆
		$this->_check_login ();
		//
		$this->assign('host',C('HOST'));
		$this->pageNum=C('PAGENUM');
		$this->rollPages=C('ROLLPAGES');
	}
	
	private function _init_user() {
		// $auth=cookie('auth');
		// if($auth){
		// }
		$this->_user = array (
				'adminId' => 0,
				'uname' => '',
				'status' => 0
		);
		
// 		$adminId = '';
	
// 		$userModel = D ( 'UserVerified' );
// 		$user = $userModel->infor ( $adminId, array (
// 				'adminId',
// 				'uname',
// 				'status'
// 		) );
	
// 		$this->_user = array (
// 				'adminId' => $user ['adminId'],
// 				'uname' => $user ['uname'],
// 				'status' => $user ['status']
// 		);
	
// 		if (! $this->isAjax () && ! $this->isPost ()) {
// 			$this->assign ( 'user', $this->_user );
// 		}
	}
	
	private function _check_login() {
		if (is_array ( MODULE_NAME, C ( 'LOGIN_MODULES' ) ) && ! in_array ( ACTION_NAME, C ( 'NOT_LOGIN_ACTIONS' ) ) && ! $this->_user ['adminId']) {
			// 需要登录
			if ($this->isAjax ()) {
				$this->ajaxReturn ( '', '未登录', 0 );
			} else {
				redirect ( reUrl ( ('Index/login') ) );
			}
		}
	}
	protected function isLogin(){
		$adminName=$_SESSION['adminName'];
		if($adminName==null||empty($adminName)){
			$this->redirect('Index/login');
		}
	}
}