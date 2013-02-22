<?php
$config = require(rtrim(dirname(__FILE__), '/\\') . DIRECTORY_SEPARATOR . "db_config.php");

$array=array(
		'DB_FIELDS_CACHE'=>false, //缓存字段信息，开发时不缓存
		'DB_FIELDTYPE_CHECK'=>true,  // 开启字段类型检测
		
		//'LAYOUT_ON' => false,
		'TMPL_L_DELIM' => '<{',
		'TMPL_R_DELIM' => '}>',
		'APP_GROUP_LIST'       	=> 'Admin,Public,Home',//模块分组
		'DEFAULT_GROUP'			=>	'Home',//默认分组
		'DEFAULT_MODULE'		=>	'Index',//默认模块
		'DEFAULT_ACTION'		=>	'Index',//默认操作
		
		'ABSOLUTE_PATH'=>'http://localhost:8001/SP/index.php/',
		'APP_ABSOLUTE_PATH'=>'http://localhost:8001/SP/',
		
// 		'APP_AUTOLOAD_PATH'     => 'Think.Util,@.Service,@.Impl,@.Helper,@.Com,@.ORG',// __autoLoad 机制额外检测路径设置,注意搜索顺序
// 		'LOAD_EXT_CONFIG'	=>	array('_menus_'=>'menus', '_privs_'=>'privs'),//加载扩展配置
		
		'LOG_RECORD' 		   => false, // 开启日志记录
		'LOG_LEVEL'     => 'EMERG,ALERT,CRIT,ERR,WARN,NOTICE,INFO,DEBUG,SQL', // 日志记录的级别
		
		'HTML_CACHE_ON'			=>	false,//开启静态缓存
		'HTML_PATH' 			=>	'__APP__/Html',//静态缓存保存路径
		'HTML_CACHE_TIME'		=>	60,//静态缓存的有效时间,单位秒
		'HTML_FILE_SUFFIX'      => '.html',// 默认静态文件后缀
		
		'TMPL_STRIP_SPACE'      => false,       // 是否去除模板文件里面的html空格与换行
		'TMPL_PARSE_STRING'		=> array('__PUBLIC__'=>__ROOT__.'/SP/Public'),//用户自定义模板字符串
		
		'TIME_ZONE'				=>	8,	//系统默认时区	

		'DATA_CACHE_ON'			=>	true,//是否开启数据动态缓存
		'DATA_CACHE_TYPE'		=>	'File',//动态数据缓存方式
		'DATA_CACHE_TIME'		=>	3600*24*20,//动态数据缓存的有效时间
		'DATA_CACHE_SUBDIR'		=>	true,//文件缓存方式是否使用子目录方式
		'DATA_PATH_LEVEL'		=>	2,//文件缓存方式使用子目录方式的目录深度
		'DATA_CACHE_COMPRESS'	=>	true,//是否开启缓存数据压缩
		//'DATA_CACHE_TIMEOUT'	=>	false,
		'MEMCACHE_HOST'			=>	'127.0.0.1',
		'MEMCACHE_PORT'			=>	11211,
		
		'DEFAULT_THEME'			=>	'',//默认模板主题
		'OPEN_PLATFORM'			=>	array('sina', 'qq'),//开启的开放平台
		
);

return array_merge($config,$array);
?>