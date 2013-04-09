<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($title); ?></title>
	<link rel="stylesheet" type="text/css"
		href="__PUBLIC__/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" type="text/css"
		href="__PUBLIC__/css/bootstrap.min.css" />	
		<link rel="stylesheet" type="text/css"
		href="__PUBLIC__/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css"
		href="__PUBLIC__/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css"
		href="__PUBLIC__/css/Home/common.css" />

	<script type="text/javascript">
	    var _public_ = '__PUBLIC__';

	</script>
    <script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../../Public/js/bootstrap.js"></script>
    	<script type="text/javascript" src="../../../Public/js/jquery.js"></script>
    	<script type="text/javascript">
    	    var _public_ = '__PUBLIC__';
    	    $(document).ready(function () {
    	        var btn = $("#input-login");

    	        btn.click(function () {
    	            var UserName = getId('#UserName');
    	            var Password = getId('#Password');

    	            if (isEmpty(UserName) == 1) {
    	                $('#UserName').popover('show');
    	            } else if (isEmpty(Password) == 1) {
    	                $('#UserName').popover('hide');
    	                $('#Password').popover('show');
    	            } else {
    	                $('#UserName').popover('hide');
    	                $('#Password').popover('hide');
    	                
    	                btn.button('loading');
    	                setTimeout(function () {
    	                    btn.button("reset")
    	                }, 3600);
    	               
    	                $('form.form-signin').submit();
    	          
    	            }

    	        });

//    	        $("#UserName").focus(function () {
//    	            var UserName = getId('#UserName');
////    	            var Password = getId('#Password');

//    	            if (isEmpty(UserName) == 1) {
//    	                $('#UserName').popover('show');
//    	            } else {
//    	                $('#UserName').popover('hide');
//    	            }
//    	        });

    	         $('#btn').popover('show');
    	        $('#example').tooltip('show');

    	    });

    	    function isEmpty(str) {
    	        if (str == null || str == "") {
    	            return 1;
    	        } else {
    	            return 0;
    	        }
    	    }

    	    function getId(id) {
    	        return $(id).attr('value');
    	    }

	</script>

    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      
      .form-signin-heading
      {
          font-size: 1.2em;
          font-weight: bold;
          padding: 0;
          margin-left: 23%;
      }
    .form-signin-heading .icon-home,.form-signin-heading .icon-wrench
     {
         padding: 3px 0 1px 0;
         margin: 7px 0 0;
     }
      
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      #login
      {
          width: 700px;
          height:auto;
          margin: 0 20% 0 25%;
      }
      #footer .label-footer
      {
          margin: 0 35% 0 40%;
      }
      .td-left
      {
          width: auto;
         }
    </style>
</head>
<body>
<div id="header"></div>

<div id="login" class="container">
<fieldset>
<legend>
 <label class="form-signin-heading"><i class="icon-home"></i> 后台登录 <i class="icon-wrench"></i></label>
 </legend>
<form action="" method="post" class="form-signin" >
<table>
<tr>
<td class="td-left"><i class="icon-user"></i> 用户名：</td>
<td class="td-right"><input type="text" id="UserName" name="UserName" rel="popover" title="请输入用户名！" data-content="用户名不能为空！" data-placement="right" class="input-block-level" placeholder="Email address" value="<?php echo ($user); ?>" /></td>
</tr>
<tr>
<td class="td-left"><i class="icon-lock"></i> 密码：</td>
<td class="td-right"><input type="password" id="Password" name="Password" rel="popover" title="请输入密码！" data-content="密码不能为空！" data-placement="right" class="input-block-level" placeholder="Password" value="" /></td>
</tr>
<tr>
 
<td colspan="2" class="td-left">    
 <label class="checkbox"><input type="checkbox" name="remember" checked="checked" value="checked" />Remember me</label>
</td>
</tr>
<tr>
<td><input id="input-login" class="btn btn-primary btn-inverse" data-loading-text="登录中." type="button" value="登录" /></td>
<td><a href='#'>忘记密码？</a></td>
</tr>
</table>

</form>
</fieldset>
 <div style="display:<?php echo ($display); ?>; " class="alert alert-error">
 <?php echo ($error); ?><button type="button" class="close" data-dismiss="alert">&times;</button>
</div>

</div>
 <!-- /container -->


<!--
 <div class="span5 well pricehover">
  <h3>图标List</h3>
  
    <ul class="nav nav-list">
          <li class="nav-header">List header</li>
          <li class="active"><a href="#"><iclass="icon-white icon-home"></i> Home</a></li>
          <li><a href="#"><i class="icon-book"></i> Library</a></li>
          <li><a href="#"><i class="icon-pencil"></i> Applications</a></li>
          <li class="nav-header">Another list header</li>
          <li><a href="#"><i class="icon-user"></i> Profile</a></li>
          <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="icon-flag"></i> Help</a></li>
        </ul>
      
        </div>
    
   <div class="control-group">
  <label class="control-label" for="inputIcon">邮箱地址</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="span2" id="inputIcon" type="text">
    </div>
  </div>
</div>

<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> 用户</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="#"><i class="icon-pencil"></i> 编辑</a></li>
    <li><a href="#"><i class="icon-trash"></i> 删除</a></li>
    <li><a href="#"><i class="icon-ban-circle"></i> 禁止</a></li>
    <li class="divider"></li>
    <li><a href="#"><i class="i"></i> 编辑</a></li>
  </ul>
</div>

<div class="btn-toolbar">
  <div class="btn-group">
    <a class="btn" href="#"><i class="icon-align-left"></i></a>
    <a class="btn" href="#"><i class="icon-align-center"></i></a>
    <a class="btn" href="#"><i class="icon-align-right"></i></a>
    <a class="btn" href="#"><i class="icon-align-justify"></i></a>
  </div>
</div>

<div>
<ul class="nav nav-list">
  <li class="active"><a href="#"><i class="icon-home icon-white"></i> 首页</a></li>
  <li><a href="#"><i class="icon-book"></i> 库</a></li>
  <li><a href="#"><i class="icon-pencil"></i> 应用程序</a></li>
  <li><a href="#"><i class="i"></i> 其他</a></li>
</ul>
</div>

<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> User</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
    <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
    <li class="divider"></li>
    <li><a href="#"><i class="i"></i> Make admin</a></li>
  </ul>
</div>


<div class="control-group">
  <label class="control-label" for="inputIcon">Email address</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="span2" id="inputIcon" type="text">
    </div>
  </div>
</div>
-->

<div id="footer">
<label class="label-footer">All Right Reserved.  Powered by SP © 2013</label>
</div>

</body>
</html>