<?php
class GoodsAction extends AdminCommonAction{
	/**
	 * ----信息分类----
	 */
	public function areaManage(){
		
		define('NOWPOWER','c040400');
		isHavePower(NOWPOWER);
		
		$currentLocal='地区管理';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
	}
	
	/**
	 * ----市场类型管理----
	 */
	public function marketTypeManage(){
	
		$currentLocal='市场类型管理';
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
		
		define('NOWPOWER','c040900');
		isHavePower(NOWPOWER);
		
		$currentLocal='商品管理';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
	}
	
} 