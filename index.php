<?php

$identity = json_decode(file_get_contents('Includes/identity.json'), true);

function generateRoutes()
{
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    $uri = '/' . trim($uri, '/');
    $routes = array();
    $routes = explode('/', $uri);
    return $routes;
}
$routes = generateRoutes();

session_start();

//Setting page name based on the url, i.e., $routes[0]
if(array_key_exists($routes[1], $identity["paths"])){
  $name = $identity["paths"][$routes[1]];
}
else{
  header('Location: '.$identity["domain"].'404');
}

require_once("Controllers/".$name."Controller.php");
require_once("Models/".$name."Model.php");
require_once("Views/".$name."View.php");

$model = new Model();
$view = new View();
$controller = new Controller($model, $view, $identity, $routes);
$controller->run();
?>
