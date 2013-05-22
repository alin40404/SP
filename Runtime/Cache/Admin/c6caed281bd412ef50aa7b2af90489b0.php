<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<title><?php echo ($title); ?></title>
<link id="skin_css" href="__PUBLIC__/css/Admin/common_green.css" type="text/css" rel="stylesheet">
<link href="__PUBLIC__/css/Admin/admin.index.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/Admin/ico.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script src="__PUBLIC__/js/jquery.cookie.js" type="text/javascript"></script>
<script src="__PUBLIC__/effects/artDialog/jquery.artDialog.min.js?skin=grey" type="text/javascript"></script>
<script type="text/javascript" src="__PUBLIC__/effects/artDialog/plugins/iframeTools.js"></script>
<script src="__PUBLIC__/js/Admin/admin.common.js" type="text/javascript"></script>

<script type="text/javascript">
	(function(config) {
		config['background'] = '#000';
		config['opacity'] = 0.1;
		config['lock'] = true;
		config['fixed'] = true;
		config['okVal'] = '确定';
		config['cancelVal'] = '取消';
	})($.dialog.defaults);
</script>

</head>
<body>
<?php  require("/Tpl/Admin/AdminUser/AdminUser/$file"); ?>
	
</body>
</html>