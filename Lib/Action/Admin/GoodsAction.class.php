<?php
class GoodsAction extends AdminCommonAction{
	/**
	 * ----信息分类----
	 */
	public function inforPartition(){

		$currentLocal='信息分类';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
	}
	
	/**
	 * ----市场管理----
	 */
	public function marketManage(){
	
		$currentLocal='市场管理';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
	}
	
	/**
	 * ----商品管理----
	 */
	public function goodsManage(){
	
		$currentLocal='商品管理';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
	}
	
} 