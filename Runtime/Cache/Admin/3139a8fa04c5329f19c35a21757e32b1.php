<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($title); ?></title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F8F9FA;
}
-->
</style>
<link href="__PUBLIC__/css/Admin/skin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/Admin/common.css"  />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript">
var host =  "<?php echo ($host); ?>";
</script>
<!-- 这里可以添加css文件和javascript文件 -->
<script type="text/javascript" src="__PUBLIC__/js/bootstrap.js"></script>

</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" height="29" valign="top" background="__PUBLIC__/images/Admin/mail_leftbg.gif"><img src="__PUBLIC__/images/Admin/left-top-right.gif" width="17" height="29" /></td>
    <td width="935" height="29" valign="top" background="__PUBLIC__/images/Admin/content-bg.gif">
    <table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt"><?php echo ($currentLocal); ?></div></td>
      </tr>
    </table>
    </td>
    <td width="16" valign="top" background="__PUBLIC__/images/Admin/mail_rightbg.gif">
    <img src="__PUBLIC__/images/Admin/nav-right-bg.gif" width="16" height="29" />
    </td>
  </tr>
  <tr>
    <td height="71" valign="middle" background="__PUBLIC__/images/Admin/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9">
    <table width="100%" height="138" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="13" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="left_txt"><i class="icon-home"></i> 当前位置：<?php echo ($currentLocal); ?></td>
          </tr>
          <tr>
            <td height="20">
            <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
              <tr>
                <td></td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
          <td>
<div id="main-edit" style="border-top: thin #CCC solid;">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#home">省/直辖市</a></li>
                            <li><a href="#profile">市/区</a></li>
                            <li><a href="#messages">区/地级市/县</a></li>                     
 <!-- <li><a href="#settings">设置</a></li>-->
                        </ul>
                        <div class="tab-content">
                         <div class="tab-pane active" id="home">
							 <div id="provinceSet">
							 	
							 </div>
 
  						</div>
                            <div class="tab-pane" id="profile">
                            	<div id="citySet">
                            		
                            	</div>
                            </div>
                            <div class="tab-pane" id="messages">
								<div id="zoneSet">
									
								</div>
                            </div>
                        </div>
                    </div>
                    <!-- 地区管理 -->
                    <!-- 
    <div class="accordion" id="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    <span><i class="icon-random"></i><?php echo ($currentLocal); ?></span>
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">

                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                    <span><i class="icon-random"></i>市场类型</span>
                </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse">
                <div  class="accordion-inner">
                	<div id="tableGoods">
                		
                	</div>
                 </div>
            </div>
        </div>
    </div>
     -->
</div>
<script type="text/javascript">

    $(document).ready(function () {
		
		loadFile("provinceSet", host + "g=Admin&m=AreaSet&a=showAll");
    });
$(document).ready(function(){
	loadFile("citySet", host + "g=Admin&m=CitySet&a=showAll");
	loadFile("zoneSet", host + "g=Admin&m=ZoneSet&a=showAll");
});

$('#myTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});





</script>


  </td>
          </tr>
        </table>
          </td>
      </tr>
    </table>
    </td>
    <td background="__PUBLIC__/images/Admin/mail_rightbg.gif">&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle" background="__PUBLIC__/images/Admin/mail_leftbg.gif"><img src="__PUBLIC__/images/Admin/buttom_left2.gif" width="17" height="17" /></td>
      <td height="17" valign="top" background="__PUBLIC__/images/Admin/buttom_bgs.gif"><img src="__PUBLIC__/images/Admin/buttom_bgs.gif" width="17" height="17" /></td>
    <td background="__PUBLIC__/images/Admin/mail_rightbg.gif"><img src="__PUBLIC__/images/Admin/buttom_right2.gif" width="16" height="17" /></td>
  </tr>
</table>

</body>
</html>