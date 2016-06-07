<?php
class Template {

	protected $variables = array();
	protected $_controller;
	protected $_action;
    protected $_templatefile;

	function __construct($controller, $action) {
		$this->_controller = $controller;
		$this->_action = $action;
	}

	/** Set Variables **/

	function set($name,$value) {
		$this->variables[$name] = $value;
	}

	/** Display Template **/

    function render() {
		extract($this->variables);


		include (ROOT . DS . 'app' . DS . 'Modules' . DS . 'default' . DS . 'View' . DS . 'layout' . DS . 'header.php');

		if (file_exists(ROOT . DS . 'app'. DS . 'Modules' . DS . 'default' . DS . 'View' . DS . 'scripts' . DS . strtolower($this->_controller) . DS . $this->_action . '.php')) {
			include (ROOT . DS . 'app' . DS . 'Modules' . DS . 'default' . DS . 'View' . DS . 'scripts' . DS . strtolower($this->_controller) . DS . $this->_action . '.php');
		} else {
			include (ROOT . DS . 'app'  . DS . 'Modules' . DS . 'default' . DS . 'View' . DS . 'scripts' . DS . strtolower($this->_controller) . DS . 'index.php');
		}

		include (ROOT . DS . 'app' . DS . 'Modules' . DS . 'default' . DS . 'View' . DS . 'layout' . DS . 'footer.php');
    }

}
