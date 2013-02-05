<?php
/**
 * EmptyCommonAction.class.php
 * @author alin.chen
 *
 */
class EmptyCommonAction extends Action{
	public function index(){
		$content=<<<SHOW
<h2>404</h2>
SHOW;
		echo $content;
	}
}