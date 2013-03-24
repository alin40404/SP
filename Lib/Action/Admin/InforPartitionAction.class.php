<?php
class InforPartitionAction extends AdminCommonAction {
	private $pageNum = 5;
	public function showAll() {
		$style = "none";
		if ($_GET ['search'] == "search") {
			unset ( $_GET ['search'] );
			$_POST = stripslashesDeep ( $_POST );
			$cname = $_GET ['cname'];
			$data = infor_partition_searchByName ( $cname,$this->pageNum );
			$total=infor_partition_searchNum($cname);
			$count= count ( $data );
			$page = searchPage ( $count);
			$style = "block";
			$class = "alert alert-success";
			$infor="共".$total."个结果，显示".$count."个";
		} else {
			if ($_POST) {
				$p = $_POST ['p'];
			} else {
				$p = $_GET ['p'];
				if ($_GET ['style']) {
					$style = "block";
					$class = $_GET ['class'];
					$infor = $_GET ['infor'];
				}
			}
			$p = intval ( $p );
			$data = infor_partition_setPageList ( $p, $this->pageNum );
			$page = infor_partition_setPage ( $p, $this->pageNum );
		}
		
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'infor', $infor );
		
		// dump($data);
		// dump($page);
		$spPlaceHolder = "商品名称";
		$this->assign ( "data", $data );
		$this->assign ( 'pgInfo', $page ['pgInfo'] );
		$this->assign ( 'page', $page ['page'] );
		$this->assign ( "spPlaceHolder", $spPlaceHolder );
		$this->display ();
	}
	public function editByName() {
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$cid = $_POST ['id'];
			$cname = $_POST ['key'];
			$p = $_POST ['p'];
			$result = infor_partition_editById ( $cid, $cname );
			// dump($result);
			if ($result) {
				$infor = "修改成功！";
				$class = "alert alert-success";
			} else {
				$infor = "商品名称已存在！";
				$class = "alert alert-error";
			}
			$style = "block";
		}
		
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
	public function addByName() {
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$cname = $_POST ['key'];
			$p = $_POST ['p'];
			$result = infor_partition_addByName ( $cname );
			if ($result) {
				$infor = "增加成功！";
				$class = "alert alert-success";
			} else {
				$infor = "商品名称已存在，增加失败！";
				$class = "alert alert-error";
			}
			$style = "block";
		}
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
	
	public function deleteByCid(){
		if($_POST){
			$_POST = stripslashesDeep ( $_POST );
			$cid=$_POST ['id'];
			$p = $_POST ['p'];
			$result = infor_partition_deleteByCid ( $cid );
		
			if ($result) {
				$infor = "删除成功！";
				$class = "alert alert-success";
			} else {
				$infor = "删除失败！";
				$class = "alert alert-error";
			}
			$style = "block";
		}
	
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	
	public function searchByName() {
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$cname = $_POST ['key'];
			$search = "search";
		}
		
		$this->redirect ( 'showAll', array (
				'search' => $search,
				'cname' => $cname 
		) );
	}
	

}