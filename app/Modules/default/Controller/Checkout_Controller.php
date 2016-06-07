<?php

class Checkout_Controller extends Controller {

	public function indexAction()
    {
		if(!isset($_SESSION['userid']))
		{

		} else {
			$this->set("bLoggedIn", true);
		}
	}

}
