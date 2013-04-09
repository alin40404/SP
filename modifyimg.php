<?php
//$modifyimg_url="Public/upload/img/";
include_once 'Common/common.php';
$upload_url="Runtime/Temp/img/upload/";
$modifyimg_url="Runtime/Temp/img/modify/";
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		//删除会员以前的头像
		if(file_exists($MemberFace)) {
			unlink($MemberFace);
		}
		$MemberFace = sliceBanner("",$modifyimg_url);
		echo json_encode($MemberFace);
		exit;
	}
	
	function sliceBanner($UserName="",$modifyimg_url="./"){
		$x = (int)$_POST['x'];
		$y = (int)$_POST['y'];
		$w = (int)$_POST['w'];
		$h = (int)$_POST['h'];
		$pic = $_POST['src'];
		
		//剪切后小图片的名字
		//$str = explode(".",$pic);//图片的格式
		//$type = $str[1]; //图片的格式
		 $type=strrchr($pic,'.');//图片的格式
		 $pathinfor=pathinfo($pic);
		 if($UserName===""){
		 	$filename=$pathinfor["basename"];
		 	$UserName=substr_replace($filename, "", strrpos($filename,'.'));
		 }
		$filename = $UserName. $type; //重新生成图片的名字
		$uploadBanner = $pic;
		if(!file_exists($modifyimg_url)){
			mkdirs($modifyimg_url);
		}
		$sliceBanner = $modifyimg_url.$filename;//剪切后的图片存放的位置
		
		//创建图片
		$src_pic = getImageHander($uploadBanner);
		$dst_pic = imagecreatetruecolor($w, $h);
		imagecopyresampled($dst_pic,$src_pic,0,0,$x,$y,$w,$h,$w,$h);
		switch ($type){
			case '.gif':
				imagegif($dst_pic,$sliceBanner);
				break;
				case '.jpg':
					imagejpeg($dst_pic, $sliceBanner);
					break;
					case '.png':
						imagepng($dst_pic, $sliceBanner);
						break;
						default:
							imagepng($dst_pic, $sliceBanner);
							break;
		}
		
		imagedestroy($src_pic);
		imagedestroy($dst_pic);
		
		//删除已上传未裁切的图片
		if(file_exists($uploadBanner)) {
			unlink($uploadBanner);
		}
		$picsize=getimagesize($sliceBanner);
		$width=$picsize[0];
		$height=$picsize[1];
		$size=round($width*$height/1024,2);
		$img=array(
				'name'=>$filename,
				'pic'=>$sliceBanner,
				'size'=>$size,
				'width'=>$width,
				'height'=>$height
				);
		
		//返回新图片的位置
		return $img;
	}
	//初始化图片
	function getImageHander ($url) {
		$size=@getimagesize($url);
		switch($size['mime']){
			case 'image/jpeg': $im = imagecreatefromjpeg($url);break;
			case 'image/gif' : $im = imagecreatefromgif($url);break;
			case 'image/png' : $im = imagecreatefrompng($url);break;
			default: $im=false;break;
		}
		return $im;
	}
?>
