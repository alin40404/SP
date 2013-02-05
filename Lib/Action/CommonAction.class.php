<?php

/**
 * CommonAction.class.php
 * @copyright			copyright(c)  2013
 * @author alin.chen
 * @contact        QQ:302592040 Email:302592040@qq.com
 */
class CommonAction extends Action{
	/**
	 * 获取或设置配置数据
	 * @var mix
	 */
	protected $_siteConfig=null;
	/**
	 * 获取或设置获取当前链接的上一个连接的来源地址
	 * @var String
	 */
	protected $_refererUrl=null;
	
	protected function _initialize(){
		unset($_SESSION['__hash__']);
		//对用户传入的变量进行转义操作。
		if(get_magic_quotes_gpc()){
			if(!empty($_GET)){
				$_GET=stripslashesDeep($_GET);
			}
			if(!empty($_POST)){
				$_POST=stripslashesDeep($_POST);
			}
			$_COOKIE=stripslashesDeep($_COOKIE);
			$_REQUEST=stripslashesDeep($_REQUEST);
		}
		
		$this->_siteConfig=load_config();
		$this->_refererUrl=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
		
		if(!$this->isAjax()&&!$this->isPost()){
			$this->assign('_siteConfig',$this->_siteConfig);
			$this->assign('_refererUrl',$this->_refererUrl);
				
		}
		
	}
	
	/**
	 * 是否Post请求
	 * @access protected
	 * @return boolean
	 */
	protected function isPost(){
		if(isset($_SERVER['REQUEST_METHOD'])){
			if('post'===strtolower($_SERVER['REQUEST_METHOD'])){
				return true;
			}
		}
		return false;
	}
	
	
}