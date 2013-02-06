<?php

/**
 * CommonAction.class.php
 * @copyright			copyright(c)  2013
 * @author alin.chen
 * 
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
	
	/**
	 +----------------------------------------------------------
	 * 操作成功跳转的快捷方法
	 +----------------------------------------------------------
	 * @access protected
	 +----------------------------------------------------------
	 * @param string $message 提示信息
	 * @param string $jumpUrl 页面跳转地址
	 * @param Boolean $ajax 是否为Ajax方式
	 +----------------------------------------------------------
	 * @return void
	 +----------------------------------------------------------
	 */
	protected function success($message,$jumpUrl='',$ajax=false){
		if(!$ajax){
			$this->assign('title','提示信息-');
		}
		parent::success($message,$jumpUrl,$ajax);
		exit;
	}
	
	/**
	 +----------------------------------------------------------
	 * 操作错误跳转的快捷方法
	 +----------------------------------------------------------
	 * @access protected
	 +----------------------------------------------------------
	 * @param string $message 错误信息
	 * @param string $jumpUrl 页面跳转地址
	 * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
	 +----------------------------------------------------------
	 * @return void
	 +----------------------------------------------------------
	 */
	protected function error($message,$jumpUrl='',$ajax=false){
		if(!$ajax){
			$this->assign('title','提示信息-');
		}
		parent::error($message,$jumpUrl,$ajax);
		exit;
	}
}