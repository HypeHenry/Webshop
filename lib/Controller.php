<?php
class Controller {

	protected $template;
    protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;

	function __construct($controller, $action, $queryString) {
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_template = new Template($this->_controller, $action);
	}

	public function set($name,$value) {
		$this->_template->set($name,$value);
	}

	function __destruct() {
		$this->_template->render();
	}

}
