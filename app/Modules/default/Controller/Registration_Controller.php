<?php

class Registration_Controller extends Controller {

	public function indexAction()
    {
		$oDatabase = new Database();

		if(!empty($_POST['email']))
		{
			$sEmail = $_POST['email'];

			$dbOutput = $oDatabase->getUserByEmail($sEmail);

			try {
				if ($dbOutput == null) {
					if ($_POST['password1'] == $_POST['password2']) {
						//gebruiker kan toegevoegd worden
						$aDatabaseValues = array("firstname" => $_POST['naam'],
							"lastname" => $_POST['achternaam'],
							"street" => $_POST['straat'],
							"city" => $_POST['plaats'],
							"zip" => $_POST['postcode'],
							"email" => $_POST['email'],
							"password" => md5($_POST['password1']));

						$id = $oDatabase->insertQuery("user", $aDatabaseValues);
						$this->set("bSuccess", true);
					} else {
						//wachtwoorden kloppen niet
						throw new Exception("Wachtwoorden zijn niet gelijk!");
					}
				} else {
					//gebruiker bestaat al
					throw new Exception("Gebruiker bestaat al!");
				}
			} catch(Exception $e) {
				$this->set("bError", true);
				$this->set("sErrorMessage", $e->getMessage());
				$this->set("naam", $_POST['naam']);
				$this->set("achternaam", $_POST['achternaam']);
				$this->set("straat", $_POST['straat']);
				$this->set("plaats", $_POST['plaats']);
				$this->set("postcode", $_POST['postcode']);
				$this->set("email", $_POST['email']);
			}
		}
	}

}
