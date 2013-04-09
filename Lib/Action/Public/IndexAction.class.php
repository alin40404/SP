<?php
class IndexAction extends Action{
	public function action(){
		//$upload_url="upload/face/";
	    $upload_url="/SP/Public/upload/img/";
		$action = $_GET['act'];
		if($action=='delimg'){
			$filename = $_POST['imagename'];
			if(!empty($filename)){
				unlink($upload_url.$filename);
				echo '1';
			}else{
				echo '删除失败.';
			}
		}else{
			$picname = $_FILES['mypic']['name'];
			$picsize = $_FILES['mypic']['size'];
				
			dump($_FILES);
			dump($_POST);
			
			if ($picname != "") {
				if ($picsize > 1024000) {
					echo '图片大小不能超过1M';
					exit;
				}
				$type = strstr($picname, '.');
				if ($type != ".gif" && $type != ".jpg") {
					echo '图片格式不对！';
					exit;
				}
				$rand = rand(100, 999);
				$pics = date("YmdHis") . $rand . $type;
				//上传路径
				$pic_path = $upload_url. $pics;
				move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
			}
		
			$size = round($picsize/1024,2);
			$image_size = getimagesize($pic_path);
			$arr = array(
					'name'=>$picname,
					'pic'=>$pics,
					'size'=>$size,
					'width'=>$image_size[0],
					'height'=>$image_size[1]
			);
			echo json_encode($arr);
		}
	}
	
	public function testUpload(){
		$this->display();
	}
}