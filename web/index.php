<?php
/**
* This is you FrontController, the only point of access to your webapp
*/
use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/../vendor/autoload.php';

/**
* Use Yaml components for load a config routing, $routes is in yaml app/config/routing.yml :
*
* Url will be /index.php?p=route_name
*/

$routes = Yaml::parse(file_get_contents(__DIR__.'/../app/config/routing.yml'));

if(isset($_GET['p'])){

	$currentroute = $routes[$_GET['p']]['controller'];
	$routes_array = explode(':',$currentroute);

	//ControllerClassName, end name is ...Controller
	$controller_class = $routes_array[0];

	//ActionName, end name is ...Action
	$action_name = $routes_array[1];
	$controller = new $controller_class();

	//$Request can by an object
	$request['request'] = &$_POST;
	$request['query'] = &$_GET;
    $request['session'] = &$_SESSION;

	//...
	//$response can be an object
	$response = $controller->$action_name($request);

	/**
	* Use Twig !
	*/
	require $response['view'];
}