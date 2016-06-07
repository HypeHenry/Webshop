<?php


/** Main Call Function **/

function callHook()
{
	global $url;

	/** Url in een array zetten */
	$aUrl	= explode("/",$url);

	/** Eerste waarde is NULL dus die halen weg */
	array_shift($aUrl);

	/**
	 * Vanaf hier komen de Controllers en Actions in beeld
	 * Als er een controller is volgens het het pattern: www.test.nl/controller/action
	 * dan gebruiken we die, anders gebruiken we INDEX
	 */
	if(!empty($aUrl[0])) {
		$sController = $aUrl[0];
		array_shift($aUrl);
	} else {
		$sController = 'index';
	}

	/**
	 * Nu gaan we kijken of er een action in de url staat volgens het pattern: www.test.nl/controller/action
	 * Als er een action in de url staat dan gebruiken wij hem, anders gebruiken
	 * we INDEX
	 */
	if(!empty($aUrl[0])) {
		$sAction = $aUrl[0];
		array_shift($aUrl);
	} else {
		$sAction = 'index';
	}

	//Nu maken we er een universele naam van zodat er altijd Action achter staat.
	$sAction = $sAction . "Action";

	//Alle overgebleven waarde die achter www.test.nl/controller/action komt zetten we in de querystring
	$queryString = $aUrl;

	//ucwords is een capatilize functie dus "world" wordt: World
	//daarna zetten we _Controller erbij om het universeel te houden.
	$sControllerClass = ucwords($sController) . '_Controller';
	//Vervang het - teken voor niets, dit is nodig bij bijvoorbeeld: pagina-niet-gevonden
	$sControllerClass = str_replace("-", "", $sControllerClass);

	/**
	 * Kijk of de class bestaat, als deze bestaat dan zetten we die als een nieuw object neer
	 * Bestaat de class niet en de controller dus ook niet dan sturen we de gebruiker naar pagina-niet-gevonden.
	 */
	try
	{
		if(class_exists($sControllerClass))
		{
			$oControllerClass = new $sControllerClass($sController, str_replace('Action', '', $sAction), $queryString);

			//We maken nu een check in de controller class (bijvoorbeeld Index_Controller)
			//en kijken daarin of de action die wij aan roepen als functie bestaat (bijvoorbeeld: index)
			if(method_exists($sControllerClass, str_replace('-', '', $sAction))) {
				call_user_func_array(array($oControllerClass, str_replace('-', '', $sAction)), $queryString);
			} else {
				throw new Exception("Contoller class bestaat maar de action niet.");
			}
		} else {
			throw new Exception("Controller class bestaat niet.");
		}
	} catch(Exception $e) {
		die(print_r($sAction));
		header('location: /pagina-niet-gevonden');
	}
}

/** Autoload any classes that are required **/

function __autoload($sClassName) {

	if (file_exists(ROOT . DS . 'lib' . DS . $sClassName . '.php')) {
		require_once(ROOT . DS . 'lib' . DS . $sClassName . '.php');
	} else if (file_exists(ROOT . DS . 'app' . DS . 'Modules' . DS . "default" . DS . 'Controller' . DS . $sClassName . '.php')) {
		require_once(ROOT . DS . 'app' . DS . 'Modules' . DS . "default" . DS . 'Controller' . DS . $sClassName . '.php');
	} else if (file_exists(ROOT . DS . 'app' . DS . 'Scripts' . DS . $sClassName . '.php')) {
		require_once(ROOT . DS . 'app' . DS . 'Scripts' . DS . $sClassName . '.php');
	} else {
		/* Error Generation Code Here */
	}
}

callHook();