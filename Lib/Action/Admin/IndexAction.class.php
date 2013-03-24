<?php
class IndexAction extends AdminCommonAction{
	private $host='http://localhost:8001/sp/index.php?';
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
		$adSetUrl=$this->host.'g=Admin&m=Index&a=adSet';
		$linkManage=$this->host.'g=Admin&m=Index&a=linkManage';
		$this->assign('baseSetUrl',$baseSetUrl);
		$this->assign('adSetUrl',$adSetUrl);
		$this->assign('linkManage',$linkManage);
		/** Goods模块 */
		$inforPartition=$this->host.'g=Admin&m=Goods&a=inforPartition';
		$this->assign('inforPartition',$inforPartition);
		$marketManage=$this->host.'g=Admin&m=Goods&a=marketManage';
		$this->assign('marketManage',$marketManage);
		$goodsManage=$this->host.'g=Admin&m=Goods&a=goodsManage';
		$this->assign('goodsManage',$goodsManage);
		/** Member模块 */
		$memberManage=$this->host.'g=Admin&m=Member&a=memberManage';
		$this->assign('memberManage',$memberManage);
		$manage=$this->host.'g=Admin&m=Member&a=manage';
		$this->assign('manage',$manage);
		
		
		/** otherManage模块 */
		
		
		$this->display();
	}
	
	public function right(){
		$this->display();
	}

	public function admin_top(){
		$logout=$this->host.'g=Admin&m=User&a=logout';
		$user=$_SESSION['user'];
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