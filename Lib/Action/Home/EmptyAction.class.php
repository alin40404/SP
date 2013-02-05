<?php
class EmptyAction extends EmptyCommonAction{
	public function index(){
		$module=MODULE_NAME;
		$this->error();
	}
	protected function error(){
// 		echo $name;
		$content=<<<SHOW
<h2>404</h2>
SHOW;
		echo $content;
		
	}
}