<?php

class Index_Controller extends Controller {

    private function userLoggedIn()
    {
        if(isset($_SESSION['userid']))
        {
            $oDatabase  = new Database();
            $aUser      = $oDatabase->getUserById($_SESSION['userid']);

            $this->set("loggedInUserName", $aUser['firstname']);
        }
    }

	public function indexAction()
    {
        $this->userLoggedIn();
	}

    public function testAction()
    {

    }

}
