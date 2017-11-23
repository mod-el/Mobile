<?php namespace Model\Mobile;

use Model\Core\Module;

class Mobile extends Module {
	public $options = [];
	public $isMobile = false;

	function init($options){
		$this->options = array_merge([
			'header' => 'mobile/header.php',
			'footer' => 'mobile/footer.php',
			'tablet' => 'mobile',
			'style' => false,
			'js' => false,
		], $options);

		if(!isset($_SESSION[SESSION_ID]['zk-mobile-detect'])){
			$detect = new Mobile_Detect();
			$_SESSION[SESSION_ID]['zk-mobile-detect'] = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
		}
		if(isset($_GET['site-version']) and in_array($_GET['site-version'], array('mobile', 'tablet', 'desktop'))){
			$_SESSION[SESSION_ID]['zk-mobile-detect'] = $_GET['site-version'];
		}
	}

	public function getController(array $request, $rule){
		if($rule==='m'){
			$this->isMobile = true;
			array_shift($request);
			return [
				'controller' => false,
				'prefix' => $rule,
				'redirect' => $request,
			];
		}else{
			$this->model->error('Rule not recognized.');
		}
	}
}
