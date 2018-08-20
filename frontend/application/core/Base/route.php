<?php

class Route
{
	/*private $aRouts = [

	];*/

	static function start()
	{
		
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $routes = explode('/', $uri_parts[0]);
        
        //unset($routes[0]);
		if ( isset($routes[2]) && ($routes[2]) )
			$sControllerClass = ucfirst($routes[2].'Controller');
		else
			$sControllerClass = 'MainController';

        //unset($routes[1]);
		if (class_exists($sControllerClass))
			$oController = new $sControllerClass($routes);
		else
			$oController = new Page404Controller($routes);
        
        $oController->build();

	}
    
}
