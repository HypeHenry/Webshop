<?php

class Product_Controller extends Controller {

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
        $oDatabase = new Database();
        $aProducts = $oDatabase->getProducts();

        $this->set("aProducts", $aProducts);

	}

    public function viewAction()
    {
        $this->userLoggedIn();

        $aArguments = func_get_args();

        if(!empty($aArguments[0]))
        {
            $oDatabase  = new Database();
            $aProduct   = $oDatabase->getProductById(intval($aArguments[0]));

            $this->set("aProduct", $aProduct);
            //$aArguments[0] zou het product ID kunnen zijn, dit kun je dus gebruiken.
        }

        if(!empty($aArguments[1])) {
            $this->set("bToegevoegd", true);
        }

        $this->set("sPrice", "€ 2000,-");
    }

}
