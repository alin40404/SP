<?php
class IndexAction extends AdminCommonAction{
	private $host='http://localhost:8001/sp/index.php?';
	
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
	
	public function index(){
		
		//$this->_initialize();
		$this->isLogin();
		
		$left=$this->host.'g=Admin&m=Index&a=left';
		$right=$this->host.'g=Admin&m=Index&a=right';
		$top=$this->host.'g=Admin&m=Index&a=admin_top';
		$this->assign('top',$top);
		$this->assign('left',$left);
		$this->assign('right',$right);
		
		$this->display();
		//dump($_SESSION);
	}
	
	public function left(){
		/** Index模块 */
		$baseSetUrl=$this->host.'g=Admin&m=Index&a=admintitle';
		$rightUrl=$this->host.'g=Admin&m=Index&a=right';
		$clearCacheUrl=$this->host.'g=Admin&m=Index&a=clearCache';
		$this->assign('baseSetUrl',$baseSetUrl);
		$this->assign('rightUrl',$rightUrl);
		$this->assign('clearCacheUrl',$clearCacheUrl);
		
		/** Goods模块 */
		$areaManage=$this->host.'g=Admin&m=Goods&a=areaManage';
		$this->assign('areaManage',$areaManage);
		$marketTypeManage=$this->host.'g=Admin&m=Goods&a=marketTypeManage';
		$this->assign('marketTypeManage',$marketTypeManage);
		$marketManage=$this->host.'g=Admin&m=Goods&a=marketManage';
		$this->assign('marketManage',$marketManage);
		$goodsManage=$this->host.'g=Admin&m=Goods&a=goodsManage';
		$this->assign('goodsManage',$goodsManage);
		/** Member模块 */
		$memberManage=$this->host.'g=Admin&m=Member&a=memberManage';
		$this->assign('memberManage',$memberManage);

		/** AdminUser */
		$group=$this->host.'g=Admin&m=AdminUser&a=group';
		$this->assign('group',$group);
		$role=$this->host.'g=Admin&m=AdminUser&a=role';
		$this->assign('role',$role);
		$adminUserManage=$this->host.'g=Admin&m=AdminUser&a=adminUserManage';
		$this->assign('adminUserManage',$adminUserManage);
		
		
		
		$this->display();
	}
	
	/**
	 * 后台首页
	 */
	public function right(){
		
		define('NOWPOWER','c020100');
		isHavePower(NOWPOWER);
		
		$originDB=new OriginModel();
		$sql_member="select * from ". C('DB_PREFIX')."member";
		$memberSum  =$originDB->getRowsNum($sql_member);
		$memberSum=($memberSum)?$memberSum:0;
		
		$table_group =  C('DB_PREFIX').'group';
		$table_role =  C('DB_PREFIX').'role';
		$table_admin =  C('DB_PREFIX').'admin';
		$sql = 'SELECT a.Id,a.adminName,a.realName,a.sex,a.loginTimes,a.lastLoginIP,a.lastLoginTime,g.gName,r.rName FROM '.$table_admin.' AS a LEFT JOIN '.$table_role.' AS r ON a.rId=r.Id LEFT JOIN '.$table_group.' AS g  ON r.gId = g.Id WHERE adminName="'.$_SESSION['adminName'].'"';
		$admin =$originDB->getOneRow($sql);
		$admin['lastLoginTime']=date("Y-d-m H:i:s",$admin['lastLoginTime']);
		$this->assign('memberSum',$memberSum);
		$this->assign('admin',$admin);
		$this->display();
	}
	
	/**
	 * 清除缓存
	 */
	public function clearCache(){
		$adminId=$_SESSION['adminId'];
		if(!isset($adminId)||empty($adminId)){
			$descibe="请登录！";
			$html_str = dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=Index&a=login";','succeed');
			exit($html_str);
				
		}
		
		clearImgCache();
		clearCacheFile();
		clearLogFile();
		clearPowerCache();
		
		$power=getPower();
		setPowerCacheFile($power);
		
		$descibe="清除缓存成功！";
		exit(dialog_toURL($descibe,'window.history.back();','succeed'));
				
// 		$html_str = dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=Index&a=login";','succeed');
// 		exit($html_str);
		
		
	}
	
	public function admin_top(){
		$logout=$this->host.'g=Admin&m=AdminUser&a=adminUserManage&d=logout';
		$user=$_SESSION['adminName'] ;
		$this->assign('user',$user);
		$this->assign('logout',$logout);
		
		//dump($_COOKIE);
		//dump($_SESSION);
		$this->display();
	}
	
	/**
	 *
	 * ----基本设置------
	 */
	public function admintitle(){
		
		define('NOWPOWER','c020101');
		isHavePower(NOWPOWER);
		$d=getvar('d');
		if($d==''||$d=='list'){
			$webName=C('WEB_NAME');
			$webAddr=C('HOST_HTTP');
			$bakNum=C('WEB_BAK_NUM');
		}else if($d=='modideal'){
			$webName=$_POST['webName'];
			$webAddr=$_POST['webAddr'];
			$bakNum=$_POST['bakNum'];
			
			C('WEB_NAME',$webName);
			C('HOST_HTTP',$webAddr);
			C('WEB_BAK_NUM',$bakNum);
			$descibe="修改成功！";
			exit(dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=Index&a=admintitle";','succeed'));
						
		}
		$this->assign('webName',$webName);
		$this->assign('webAddr',$webAddr);
		$this->assign('bakNum',$bakNum);
		
		$currentLocal='基本设置';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
	}
	
	/**
	 * ---广告设置---
	 */
	public function adSet(){
		$currentLocal='广告设置';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
		
	}
	
	/**
	 * ----链接管理----
	 */
	public function linkManage(){
		$currentLocal='链接管理';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
		
	}
}