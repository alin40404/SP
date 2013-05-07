<?php
class GoodsSetAction extends AdminCommonAction{
	//
	public function showAll() {
		$style = "none";
		$db =D ( 'Goods' );
		
		$db_a = D ( 'Assortment' );
		$db_gv = D ( 'GoodsVariety' );
	
		$assortment = $db_a->getAll ();
		$this->assign ( 'assortment', $assortment );
		$aid = $assortment [0] ['aid'];
		$aname = $assortment [0] ['aname'];
		
// 		$goodsVariety=$db_gv->getAll();
// 		$this->assign('goodsVariety',$goodsVariety);
// 		$vid=$goodsVariety[0]['vid'];
// 		$vname=$goodsVariety[0]['vname'];

	    $addClass="accordion-body collapse";
	    $search="";
		if ($_SERVER['REQUEST_METHOD']=='GET') {
			if ($_GET ['style']) {
				unset ( $_GET ['style'] );
				$style = "block";
				$class = $_GET ['class'];
				$infor = $_GET ['infor'];
				$aid = $_GET ['aid'];
				$aname = $_GET ['aname'];
				$vid = $_GET ['vid'];
				$vname = $_GET ['vname'];
				$addClass=($_GET['addClass']==""?$addClass:$_GET['addClass']);
				unset($_GET['addClass']);
			}
			$p = $_GET ['p'];
		} else if ($_SERVER['REQUEST_METHOD']=='POST') {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			$aid = $_POST ['aid'];
			$aname = $_POST ['aname'];
			$vid=$_POST['vid'];
			$vname=$_POST['vname'];
			$search=(isset($_POST['key'])?trim($_POST['key']):$search);
			
		}
		
		$goodsVariety = $db_gv->selectByAid ( $aid );
		$this->assign ( 'goodsVariety', $goodsVariety );
		if (! isset ( $vid ) || empty ( $vid )) {
			$vid = $goodsVariety [0] ['vid'];
			$vname = $goodsVariety [0] ['vname'];
		}
		
		$p=($p==false?1:$p);
		$p = intval ( $p );
		$data = $db->setPageList ( $p, $this->pageNum,$vid,$search);
		if(!empty($search)){
			$count =$db->getTheSearchNum($vid,$search);
			$infor="搜索结果如下，共".$count."条信息";
			$class = "alert alert-success";
			$style = "block";
		}else{
			$count =$db->getTheNum($vid);
		}
		$page = showPage ( $count, $p, $this->pageNum, $this->rollPages );

		
		$this->assign('addClass',$addClass);
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'infor', $infor );
		$group = "Admin";
		$this->assign ( 'group', $group );
		$module = "GoodsSet";
		$this->assign ( 'module', $module );
		$replaceId = "goods1";
		$this->assign ( 'replaceId', $replaceId );
		$pref = "goods";
		$this->assign ( 'pref', $pref );
		// dump($data);
		// dump($page);
	
		$this->assign ( 'aid', $aid );
		$this->assign ( 'aname', $aname );
		$this->assign ( 'vid', $vid );
		$this->assign ( 'vname', $vname );
		
		$this->assign('search',$search);
		$spPlaceHolder = "名称";
		$this->assign ( "data", $data );
		$this->assign ( 'pgInfo', $page ['pgInfo'] );
		$this->assign ( 'page', $page ['page'] );
		$this->assign ( "spPlaceHolder", $spPlaceHolder );
		$this->display ();
	}
	
	public function editByName() {
		$db =D ( 'Goods' );
		$db1 = D ( 'GoodsVariety' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$post_array=array();
			$id = $_POST ['id'];
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			$gdesc=	$_POST['gdesc'];
			$img=$_POST['img'];
			unset($_POST['key']);
			$post_array=$_POST;
			
			$array=$db->selectById($id);
			$vid=$array['vid'];
			
 			$result = $db->editById ( $id, $name ,$gdesc,$img);
				
			if ($result) {
				$infor = "修改成功！";
				$class = "alert alert-success";
			} else {
				$infor = "修改失败！";
				$class = "alert alert-error";
			}
			$style = "block";
			$post_array['infor']=$infor;
			$post_array['class']=$class;
			$post_array['style']=$style;
		}
	
		$this->redirect ( 'showAll',$post_array);
	}
	public function addByName() {
		$db =D ( 'Goods' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$post_array=array();
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			$id=$_POST['vid'];
			$gdesc=	$_POST['gdesc'];
			$img=$_POST['img'];
			unset($_POST['key']);
			$post_array=$_POST;
			
			if(file_exists($img)){
				$pathinfo=pathinfo($img);
				$filename=$pathinfo['basename'];
				$savePath=C('UPLOAD_GOODS_IMG_URL');
				if(!file_exists($savePath)){
					mkdirs($savePath);
				}
				copy($img, $savePath.$filename);
// 				move_uploaded_file($img,$savePath.$filename);
				unlink($img);
				
				$img=$savePath.$filename;
			}else{
				$img=C('DEFAULT_GOODS_IMG');
			}
			
			$result = $db->addByName ($id,$name,$gdesc, $img);

			if ($result) {
				$infor = "增加成功！";
				$class = "alert alert-success";
			} else {
				$infor = "名称已存在，增加失败！";
				$class = "alert alert-error";
			}
			$addClass='accordion-body collapse in';
			$style = "block";
			$post_array['infor']=$infor;
			$post_array['class']=$class;
			$post_array['style']=$style;
			$post_array['addClass']=$addClass;
		}
		$this->redirect ( 'showAll',$post_array);
	}
	public function deleteById() {
		$db =D ( 'Goods' );
	
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$post_array=array();
			$id = $_POST ['id'];
			$p = $_POST ['p'];
			$post_array=$_POST;
			
			$array=$db->selectById($id);
			$vid=$array['vid'];
			$gimg=$array['gimg'];
			if(file_exists($gimg)&&$gimg!=C('DEFAULT_GOODS_IMG')){
				unlink($gimg);
			}
			
			$result = $db->deleteById ( $id );
	
			if ($result) {
				$infor = "删除成功！";
				$class = "alert alert-success";
			} else {
				$infor = "删除失败！";
				$class = "alert alert-error";
			}
			$style = "block";
			$post_array['infor']=$infor;
			$post_array['class']=$class;
			$post_array['style']=$style;
		
		}
	
		$this->redirect ( 'showAll',$post_array);
	}
	
	
	public function editAll() {
		$db =D ( 'Goods' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $id => $array ) {
				dump($array);
				$name=$array['name'];
				$gdesc=$array['gdesc'];
				$img=$array['img'];
 				$result = $db->editById ( $id, $name,$gdesc,$img);
				if ($result) {
					$editNum ++;
				}
			}
	
			$array=$db->selectById($id);
			$vid=$array['vid'];
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "保存成功！";
			$class = "alert alert-info";
			$style = "block";
			$post_array['infor']=$infor;
			$post_array['class']=$class;
			$post_array['style']=$style;
		}
	
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'vid'=>$vid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	
	public function deleteAll() {
		$db =D ( 'Goods' );
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
					$vid=$array['vid'];
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
				'vid'=>$vid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
}