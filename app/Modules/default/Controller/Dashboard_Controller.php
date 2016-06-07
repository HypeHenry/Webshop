<?php

class Dashboard_Controller extends Controller {

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

        if(isset($_SESSION['userid']))
        {
            $oDatabase  = new Database();
            $aUser      = $oDatabase->getUserById($_SESSION['userid']);
            $aInvoices  = $oDatabase->getInvoicesByUserId($_SESSION['userid']);
            $this->set("aInvoices", $aInvoices);
            $this->set("aUser", $aUser);
        }
        else
        {
            header("location: /login");
        }
	}

    public function testAction()
    {

    }

}
