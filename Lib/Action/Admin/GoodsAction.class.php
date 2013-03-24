<?php
class GoodsAction extends AdminCommonAction{
	/**
	 * ----信息分类----
	 */
	public function inforPartition(){
// 		$category=D('Category');
// 		if($_POST){
			
// 		}else{
// 			$op=$_GET['op'];
// 			switch ($op){
// 				case "addByName":
// 					$cname=$_GET['cname'];
// 					$data=infor_partition_addByName($cname);
// 					break;
// 			}
// 		}
// 		$data=infor_partition_getAll();
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