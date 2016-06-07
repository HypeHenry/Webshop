<?php

class Winkelmandje_Controller extends Controller {

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

	public function producttoevoegenAction()
	{
		$this->userLoggedIn();
		$oDatabase = new Database();

		if(!isset($_SESSION['shoppingcart_id']))
		{
			$aNewShoppingCart	= array("user_id" => $_SESSION['userid']);
			$insertId			= $oDatabase->insertQuery("shopping_cart", $aNewShoppingCart);

			$_SESSION['shoppingcart_id'] = $insertId;
		}

		$aProductToevoegen = array("product_id" => intval($_POST['product_id']),
			"shopping_cart_id" => $_SESSION['shoppingcart_id'],
			"quantity" => intval($_POST['aantal']));

		$oDatabase->insertQuery("shopping_cart_inside", $aProductToevoegen);
		header("location: /product/view/" . $_POST['product_id'] . "/success");
	}

}
