<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo ($title); ?></title>
	<link rel="stylesheet" type="text/css"
		href="__PUBLIC__/Css/Home/bootstrap-responsive.min.css" />
	<link rel="stylesheet" type="text/css"
		href="__PUBLIC__/Css/Home/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css"
		href="__PUBLIC__/Css/Home/common.css" />

	<script type="text/javascript">
		var _public_ = '__PUBLIC__';
	</script>
	<script type="text/javascript" src="__PUBLIC__/Js/bootstrap.min.js"></script>
</head>

<body>

	<div id="header">
		<!-- 响应式导航条 -->
		<div class="navbar navbar-inverse">
				<div id="conHeader" class="container">
					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
					<a class="btn btn-navbar" data-toggle="collapse"
						data-target=".nav-collapse"> <span class="icon-bar"></span> <span
						class="icon-bar"></span> <span class="icon-bar"></span>
					</a>
					<div  class="nav-collapse collapse">
						<span><a href="#">加关注</a>| <a href="#">收藏SP</a>| <a
							href="#">网站首页</a>| <a href="#">联系我们</a></span>
					</div>
				</div>
			</div>
		
	</div>
	<div class="page">
		<div id="main"></div>
	</div>

	<!-- footer -->
	<div class="footer empty"></div>
	<div id="footer">
		<div class="container">
			<p class="muted credit">
				All Right Reserved <a href="#">Alin</a> Copyright © 2012 <a
					href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.
			</p>
		</div>
	</div>

</body>
</html>