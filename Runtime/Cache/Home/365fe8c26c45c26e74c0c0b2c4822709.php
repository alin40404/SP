<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2012年度盘点</title>
<link rel="stylesheet" type="text/css" href="<?php echo (C("APP_ABSOLUTE_PATH")); ?>Public/css/show.css" />
	<script id="jquery_183" type="text/javascript" class="library" src="<?php echo (C("APP_ABSOLUTE_PATH")); ?>Public/js/jquery.min.js"></script>
<script type="text/javascript">
var m=0;
$(document).ready(function(){
	$(".mindiv").hover(function(){
		m = $(this).val();
		//alert(m);
		if(m>0){
		$(this).children(".divbox").stop(true, true).animate({"top":"0%"},200); 
		
		}
		else{
		$(this).children(".divbox").stop(true, true).animate({"top":"-100%"},200);
		
		}
		
	},function(){
		$(this).attr("value",m);
});
	$(".mindiv").mouseleave(function(){
		if(m>0){
			$(this).children(".divbox").stop(true, true).animate({"top":"-100%"},200);
			m=m-1; 
		}else
			{
			$(this).children(".divbox").stop(true, true).animate({"top":"0%"},200); 
			m=m+1;
			}
	});
});

</script>

</head>
<body>
<div id="main">
  <li id="min_1" class="mindiv" value="0">
    <div class="divbox" value="0">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_2" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_3" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_4" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_5" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_6" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_7" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_8" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_9" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_10" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_11" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
  <li id="min_12" class="mindiv" value="0">
    <div class="divbox">
      <div id="box1" class="boxone"></div>
      <div id="box2" class="boxtwo"></div>
    </div>
  </li>
</div>
</body>
</html>