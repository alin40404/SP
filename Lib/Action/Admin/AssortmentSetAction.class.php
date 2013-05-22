<?php
class AssortmentSetAction extends AdminCommonAction {
	// 品种
	public function showAll() {
		define('NOWPOWER','c040904');
		isHavePower(NOWPOWER);
		
		$style = "none";
		$db = D ( 'Assortment' );
		$search = "";
		if ($_SERVER ['REQUEST_METHOD'] == 'GET') {
			if ($_GET ['style']) {
				unset ( $_GET ['style'] );
				$style = "block";
				$class = $_GET ['class'];
				$infor = $_GET ['infor'];
			}
			$p = $_GET ['p'];
		} else if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$p = $_POST ['p'];
			
			$search = (isset ( $_POST ['key'] ) ? trim ( $_POST ['key'] ) : $search);
		}
		
		$p = ($p == false ? 1 : $p);
		$p = intval ( $p );
		$data = $db->setPageList ( $p, $this->pageNum, $search );
		if (! empty ( $search )) {
			$count = $db->getTheSearchNum ( $search );
			$infor = "搜索结果如下，共" . $count . "条信息";
			$style = "block";
			$class = "alert alert-success";
		} else {
			$count = $db->getTheNum ();
		}
		$page = showPage ( $count, $p, $this->pageNum, $this->rollPages );
		
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'infor', $infor );
		$group = "Admin";
		$this->assign ( 'group', $group );
		$module = "AssortmentSet";
		$this->assign ( 'module', $module );
		$replaceId = "assortmentSet1";
		$this->assign ( 'replaceId', $replaceId );
		$pref = "assortmentSet";
		$this->assign ( 'pref', $pref );
		
		
		$this->assign('search',$search);
		$spPlaceHolder = "品种名称";
		$this->assign ( "data", $data );
		$this->assign ( 'pgInfo', $page ['pgInfo'] );
		$this->assign ( 'page', $page ['page'] );
		$this->assign ( "spPlaceHolder", $spPlaceHolder );
		$this->display ();
	}
	public function editByName() {
		


		define('NOWPOWER','c040902');
		isHavePower(NOWPOWER);
		
		
		$db = D ( 'Assortment' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			
			$result = $db->editById ( $id, $name );
			
			if ($result) {
				$infor = "修改成功！";
				$class = "alert alert-success";
			} else {
				$infor = "名称已存在！";
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
		
		define('NOWPOWER','c040901');
		isHavePower(NOWPOWER);
		
		$db = D ( 'Assortment' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			
			$result = $db->addByName ( $name );
			if ($result) {
				$infor = "增加成功！";
				$class = "alert alert-success";
			} else {
				$infor = "名称已存在，增加失败！";
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
			$name = $_POST ['key'];
			$search = "search";
		}
		
		$this->redirect ( 'showAll', array (
				'search' => $search,
				'name' => $name 
		) );
	}
	public function deleteById() {
		
		define('NOWPOWER','c040903');
		
		isHavePower(NOWPOWER);
		
		
		$db = D ( 'Assortment' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$p = $_POST ['p'];
			
			$result = $db->deleteById ( $id );
			
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
	public function editAll() {
		
		define('NOWPOWER','c040902');
		isHavePower(NOWPOWER);
		
		
		$db = D ( 'Assortment' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $id => $name ) {
				$result = $db->editById ( $id, $name );
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
		
		define('NOWPOWER','c040903');
		isHavePower(NOWPOWER);
		
		$db = D ( 'Assortment' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			
			foreach ( $data as $id => $name ) {
				$result = $db->deleteById ( $id );
				if ($result) {
					$editNum ++;
				}
				$first = false;
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