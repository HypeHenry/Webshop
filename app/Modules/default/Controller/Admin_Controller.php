<?php

class Admin_Controller extends Controller {

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
        $oDatabase = new Database();
        $this->userLoggedIn();

        $aCategories = $oDatabase->getCategories();
        $this->set("aCategories", $aCategories);

        if(!empty($_POST['naam']))
        {
            try {

                $target_dir = ROOT . "/public_html/Uploads/";
                $target_file = $target_dir . basename($_FILES["foto"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["naam"])) {
                    $check = getimagesize($_FILES["foto"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        throw new Exception("File is not an image.");
                        $uploadOk = 0;
                    }
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . rand(5, 15) . "-" . basename($_FILES["foto"]["name"]));
                    $uploadOk = 1;
                    $bAlreadyExist = true;
                }
                // Check file size
                if ($_FILES["foto"]["size"] > 500000) {
                    throw new Exception("Sorry, your file is too large.");
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    throw new Exception("Sorry, your file was not uploaded.");
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file) || $bAlreadyExist == true) {

                        $oDatabase = new Database();

                        //product word toegevoegd
                        $aDatabaseValues = array("category_id" => $_POST['categorie'],
                            "name" => $_POST['naam'],
                            "price" => $_POST['prijs'],
                            "quantity" => $_POST['voorraad'],
                            "description" => $_POST['beschrijving'],
                            "article_nr" => $_POST['artikelnummer']);

                        $id = $oDatabase->insertQuery("product", $aDatabaseValues);


                        $aValuesForDatabase = array("product_id" => $id,
                                                    "filename" => $_FILES["foto"]["name"]);
                        //Rij toevoegen aan database
                        $oDatabase->insertQuery("product_image", $aValuesForDatabase);

                        echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
                    } else {
                        throw new Exception("Sorry, there was an error uploading your file.");
                    }
                }

                $this->set("bSuccess", true);

            } catch(Exception $e) {
                $this->set("bError", true);
                $this->set("sErrorMessage", $e->getMessage());
//                $this->set("naam", $_POST['naam']);
//                $this->set("achternaam", $_POST['achternaam']);
//                $this->set("straat", $_POST['straat']);
//                $this->set("plaats", $_POST['plaats']);
//                $this->set("postcode", $_POST['postcode']);
//                $this->set("email", $_POST['email']);
            }
        }
    }

    public function categorieverwijderenAction()
    {
        $aArguments = func_get_args();

        if(!empty($aArguments[0]))
        {
            $oDatabase = new Database();
            $oDatabase->deleteCategory($aArguments[0]);
            header("location: /admin/categorie-toevoegen");
        }
    }

    public function categorietoevoegenAction()
    {
        $oDatabase = new Database();
        $this->userLoggedIn();

        if (!empty($_POST['naam']))
        {
            if(strlen($_POST['naam']) >= 2)
            {

                $oDatabase->insertQuery("category", array("name" => $_POST['naam']));
                $this->set("bSuccess", true);
            } else {
                $this->set("bError", true);
            }
        }

        $aCategories = $oDatabase->getCategories();
        $this->set("aCategories", $aCategories);
    }

}
