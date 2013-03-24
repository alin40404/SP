<?php
class MemberAction extends AdminCommonAction{
	
	/**
	 * -----会员管理------
	 */
	public function memberManage(){
		$currentLocal='会员管理';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
	}
	
	/**
	 * ----管理员管理-----
	 */
	public function manage(){
		$currentLocal='管理员管理';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
		
	}
	
}