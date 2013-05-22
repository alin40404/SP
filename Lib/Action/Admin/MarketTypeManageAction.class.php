<?php
class MarketTypeManageAction extends AdminCommonAction {
	// private $pageNum = C('PAGENUM');
	public function showAll() {
		$style = "none";
		$db=D('Category');
		
		if ($_GET) {
			if ($_GET ['style']) {
				unset($_GET ['style']);
				$style = "block";
				$class = $_GET ['class'];
				$infor = $_GET ['infor'];
				
			}
			
			$p = $_GET ['p'];
		} else if ($_POST) {
			$p = $_POST ['p'];
		}
		
		$p = intval ( $p );

		$data = $db->setPageList ( $p, $this->pageNum );
		$count = $db->getTheNum ();
		$page = showPage ( $count, $p, $this->pageNum, $this->rollPages );
		
		if ($_GET ['search'] == "search") {
			unset ( $_GET ['search'] );
			$_POST = stripslashesDeep ( $_POST );
			$cname = $_GET ['cname'];
			$data = infor_partition_searchByName ( $cname, $this->pageNum );
			$total = infor_partition_searchNum ( $cname );
			$count = count ( $data );
			$page = searchPage ( $count );
			$style = "block";
			$class = "alert alert-success";
			$infor = "共" . $total . "个结果，显示" . $count . "个";
		} 
		
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'infor', $infor );
		$replaceId="tableGoods1";
		$this->assign('replaceId',$replaceId);
		$pref="sp";
		$this->assign('pref',$pref);
		
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
	public function deleteByCid() {
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$cid = $_POST ['id'];
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
	public function editAll() {
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $cid => $cname ) {
				$result = infor_partition_editById ( $cid, $cname );
				if ($result) {
					$editNum ++;
				}
			}
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "保存成功！";
			$class = "alert alert-info";
			$style = "block";
		}
		
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
	public function deleteAll() {
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $cid => $cname ) {
				$result = infor_partition_deleteByCid ( $cid );
				if ($result) {
					$editNum ++;
				}
			}
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "共删除" . $editNum . "条记录！";
			$class = "alert alert-info";
			$style = "block";
		}
		
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
}