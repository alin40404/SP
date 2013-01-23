<?php
return array(
	//'配置项'=>'配置值'
		'URL_MODEL'				=> 2,//URL模式,0:普通模式、2：REWRITE模式
		'URL_HTML_SUFFIX'		=> '.html',
		
		'TOKEN_ON'				=> true,
		'SESSION_PREFIX'		=> 'jihaoju_',//session前缀
		'COOKIE_PREFIX'			=> 'jihaoju_',//cookie前缀
		'HTML_CACHE_ON'			=>	false,//开启静态缓存
		'HTML_PATH' 			=>	'__APP__/Html',//静态缓存保存路径
		'HTML_CACHE_TIME'		=>	'60',//静态缓存的有效时间,单位秒
		
);
?>