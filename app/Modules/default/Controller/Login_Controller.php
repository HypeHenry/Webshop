<?php

class Login_Controller extends Controller {

	public function indexAction()
    {
		if(!empty($_POST['email']))
		{
			$oDatabase = new Database();
			$aUser	= $oDatabase->getUserByEmailAndPassword($_POST['email'], md5($_POST['password']));

			if($aUser != null)
			{
				//gebruiker bestaat en login klopt.
				$_SESSION['userid'] = intval($aUser['id']);
				header("location: /");
			}
			else
			{
				$this->set("bError", true);
			}
		}
	}

	public function logoutAction()
	{
		session_destroy();
		header("location: /");
	}

}
