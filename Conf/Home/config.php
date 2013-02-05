<?php
return array(
		'URL_MODEL' => 0, // URL模式,0:普通模式、1:默认模式、2：REWRITE模式、3：兼容模式
		'URL_HTML_SUFFIX' => '.html',//请求url网页后缀名
		'URL_PATHINFO_DEPR' => '-',//URL的路径显示
		
		'TOKEN_ON'				=> true,
		'SESSION_PREFIX'		=> 'sp_',//session前缀
		'COOKIE_PREFIX'			=> 'sp_',//cookie前缀
		'HTML_CACHE_ON'			=>	false,//开启静态缓存
		'HTML_PATH' 			=>	__APP__.'/Html',//静态缓存保存路径
		'HTML_CACHE_TIME'		=>	'60',//静态缓存的有效时间,单位秒
		
		'LOGIN_MODULES' => array (
			//	'User',
			//	'Payment'
		), // 需要登陆的模块
		
		'NOT_LOGIN_ACTIONS' => array (
			/*	'User.reg',
				'User.login',
				'User.logout',
				'User.check_nick_valid',
				'User.login_sina',
				'User.sina_callback',
				'User.login_qq',
				'User.qq_callback',
				'User.bind',
				'User.uc_synlogin',
				'User.uc_deleteuser',
				'User.uc_updatepw',
				'User.uc_renameuser',
				'User.uc_updatecredit',
				'User.getpwd',
				'Payment.pay_callback',
				'Payment.pay_notify'
				*/
		), // 不需要登陆的操作
		
		'APP_ACTION_DENY_LIST' => array(/*'User.after_logined'*/), // 禁止外部访问的操作
		
		'TMPL_ACTION_ERROR' => TMPL_PATH . 'Home/Public/success.html',
		'TMPL_ACTION_SUCCESS' => TMPL_PATH . 'Home/Public/success.html',
		'SPHINX_ON' => false,  // 开启sphinx检索引擎
		
		
);
?>