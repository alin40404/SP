<?php
//$upload_url="upload/face/";

//$upload_url="Public/upload/img/";
include_once 'Common/common.php';

$upload_url="Runtime/Temp/img/upload/";
$action = $_GET['act'];
if($action=='delimg'){
	$filename = $_POST['imagename'];
	if(!empty($filename)){
		unlink($filename);
		echo '1';
	}else{
		echo '删除失败.';
	}
}else{
	$picname = $_FILES['mypic']['name'];
	$picsize = $_FILES['mypic']['size'];
	
	
	if ($picname != "") {
		if ($picsize > 1024000) {
			echo '图片大小不能超过1M';
			exit;
		}
		$type = strrchr($picname, '.');
		if ($type != ".gif" && $type != ".jpg"&&$type!=".png") {
			echo '图片格式不对！';
			exit;
		}
		$rand = rand(100, 999);
		$pics = date("YmdHis") . $rand . $type;
		
		if(!file_exists($upload_url)){//创建文件路径
			mkdirs($upload_url);
			
		}
		//上传路径
		$pic_path = $upload_url. $pics;
		move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
	}
	
	$size = round($picsize/1024,2);
	$image_size = getimagesize($pic_path);
	$arr = array(
		'name'=>$picname,
		'pic'=>$pic_path,
		'size'=>$size,
		'width'=>$image_size[0],
		'height'=>$image_size[1]
	);
	echo json_encode($arr);
}

?>