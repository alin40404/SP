<?php
class GoodsVarietySetAction extends AdminCommonAction{
	// 
	public function showAll() {
		$style = "none";
		$db = D ( 'GoodsVariety' );
		$db1 =D ( 'Assortment' );
		
		$assortment=$db1->getAll();
		$this->assign('assortment',$assortment);
		$aid=$assortment[0]['aid'];
		$aname=$assortment[0]['aname'];
		$search="";
		if ($_SERVER['REQUEST_METHOD']=='GET') {
			if ($_GET ['style']) {
				unset ( $_GET ['style'] );
				$style = "block";
				$class = $_GET ['class'];
				$infor = $_GET ['infor'];
				$aid=$_GET['aid'];
				$array=$db1->selectById($aid);
				$aname=$array['aname'];
			}
			$p = $_GET ['p'];
		} else if ($_SERVER['REQUEST_METHOD']=='POST') {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			$aid=$_POST['aid'];
			$aname=$_POST['aname'];
			$search=(isset($_POST['key'])?trim($_POST['key']):$search);
		}
		
		$p=($p==false?1:$p);
		$p = intval ( $p );
		$data = $db->setPageList ( $p, $this->pageNum,$aid,$search);
		if(!empty($search)){
			$count =$db->getTheSearchNum($aid,$search);
			$infor="搜索结果如下，共".$count."条信息";
			$class = "alert alert-success";
			$style = "block";
		}else{
			$count =$db->getTheNum($aid);
		}
		$page = showPage ( $count, $p, $this->pageNum, $this->rollPages );

		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'infor', $infor );
		$group = "Admin";
		$this->assign ( 'group', $group );
		$module = "GoodsVarietySet";
		$this->assign ( 'module', $module );
		$replaceId = "goodsvarietySet1";
		$this->assign ( 'replaceId', $replaceId );
		$pref = "goodsvarietySet";
		$this->assign ( 'pref', $pref );
		// dump($data);
		// dump($page);
	
		$this->assign('aid',$aid);
		$this->assign('aname',$aname);
		
		$this->assign('search',$search);
		$spPlaceHolder = "名称";
		$this->assign ( "data", $data );
		$this->assign ( 'pgInfo', $page ['pgInfo'] );
		$this->assign ( 'page', $page ['page'] );
		$this->assign ( "spPlaceHolder", $spPlaceHolder );
		$this->display ();
	}
	
	public function editByName() {
			$db = D ( 'GoodsVariety' );
			
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			
			$result = $db->editById ( $id, $name );
			$array=$db->selectById($id);
			$aid=$array['aid'];
			
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
				'id'=>$aid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	public function addByName() {
		$db = D ( 'GoodsVariety' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			$id=$_POST['aid'];
			
			$result = $db->addByName ($id,$name );

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
				'aid'=>$id,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	public function deleteById() {
		$db = D ( 'GoodsVariety' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$p = $_POST ['p'];
				
			$array=$db->selectById($id);
			$aid=$array['aid'];
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
				'aid'=>$aid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	
	// 	public function searchByName() {
	// 		if ($_POST) {
	// 			$_POST = stripslashesDeep ( $_POST );
	// 			$name = $_POST ['key'];
	// 			$search = "search";
	// 		}
	
	// 		$this->redirect ( 'showAll', array (
	// 				'search' => $search,
	// 				'name' => $name
	// 		) );
	// 	}
	
	public function editAll() {
		$db = D ( 'GoodsVariety' );
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
				
			$array=$db->selectById($id);
			$aid=$array['aid'];
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "保存成功！";
			$class = "alert alert-info";
			$style = "block";
		}
	
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'aid'=>$aid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	public function deleteAll() {
		$db = D ( 'GoodsVariety' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			$first=true;
			foreach ( $data as $id => $name ) {
				if($first){
					$array=$db->selectById($id);
					$aid=$array['aid'];
				}
				$result = $db->deleteById ( $id );
				if ($result) {
					$editNum ++;
				}
				$first=false;
			}
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "共删除" . $editNum . "条记录！";
			$class = "alert alert-info";
			$style = "block";
		}
	
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'aid'=>$aid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
		

	}
}