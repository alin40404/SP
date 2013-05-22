<?php
class AreaSetAction extends AdminCommonAction {
	// 省
	public function showAll() {
		
		define('NOWPOWER','c040404');
		isHavePower(NOWPOWER);
		
		$style = "none";
		$db = D ( 'MarketProvince' );
		
		if ($_GET) {
			 if ($_GET ['style']) {
				unset ( $_GET ['style'] );
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
			$_GET = stripslashesDeep ( $_GET );
			$name = $_GET ['name'];
			$data = $db->selectByName ( $name, $this->pageNum );
			$total = $db->getTheSearchNum ( $name );
			$count = count ( $data );
			$page = searchPage ( $count );
			$style = "block";
			$class = "alert alert-success";
			$infor = "共" . $total . "个结果，显示" . $count . "个";
			//dump ( $data );
		} 
		
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'infor', $infor );
		$group = "Admin";
		$this->assign ( 'group', $group );
		$module = "AreaSet";
		$this->assign ( 'module', $module );
		$replaceId = "provinceSet1";
		$this->assign ( 'replaceId', $replaceId );
		$pref = "prv";
		$this->assign ( 'pref', $pref );
		// dump($data);
		// dump($page);
		
		$spPlaceHolder = "省";
		$this->assign ( "data", $data );
		$this->assign ( 'pgInfo', $page ['pgInfo'] );
		$this->assign ( 'page', $page ['page'] );
		$this->assign ( "spPlaceHolder", $spPlaceHolder );
		$this->display ();
	}
	public function editByName() {
		
		define('NOWPOWER','c040402');
		isHavePower(NOWPOWER);
		
		$db = D ( 'MarketProvince' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			// $result = infor_partition_editById ( $id, $name );
			$result = $db->editById ( $id, $name );
			// dump($result);
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
		
		define('NOWPOWER','c040401');
		isHavePower(NOWPOWER);
		
		$db = D ( 'MarketProvince' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			// $result = infor_partition_addByName ( $cname );
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
	public function deleteById() {
		
		define('NOWPOWER','c040403');
		isHavePower(NOWPOWER);
		
		$db = D ( 'MarketProvince' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$p = $_POST ['p'];
			// $result = infor_partition_deleteByCid ( $id );
			$result = $db->deleteById ( $id );
			;
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
			$name = $_POST ['key'];
			$search = "search";
		}
		
		$this->redirect ( 'showAll', array (
				'search' => $search,
				'name' => $name 
		) );
	}
	public function editAll() {
		
		define('NOWPOWER','c040402');
		isHavePower(NOWPOWER);
		
		$db = D ( 'MarketProvince' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $id => $name ) {
				// $result = infor_partition_editById ( $id, $name );
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
		
		define('NOWPOWER','c040403');
		isHavePower(NOWPOWER);
		
		$db = D ( 'MarketProvince' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $id => $name ) {
				// $result = infor_partition_deleteByCid ( $cid );
				$result = $db->deleteById ( $id );
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