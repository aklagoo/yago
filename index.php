<?php
/**
 * This file routes incoming requests to their corresponding controllers.
 * 
 * For mapping routes to appropriate controllers, this script checks for a key
 * "action" in the request body of an incoming request. If no such key is
 * found, it is assumed to be 'render', which, if implemented, returns a view
 * for the specified route.
 * 
 * The list of permitted actions is specified in "/app/config/routes.php". In
 * the absence of such an action, a 404 page is returned.
 */

session_start();

// Load constants and the route dictionary.
require_once( 'constants.php' );
$routeDict = require_once( BASE_PATH . '/config/routes.php' );


// Extract routes from the URL.
function extractRoute()
{
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    $uri = '/' . trim($uri, '/');
    $routes = array();
    $routes = explode('/', $uri);
    return $routes;
}
$currentRoute = extractRoute();

$action = ( isset($_POST['action']) ? $_POST['action'] : 'render');


// Check if the path is valid.
if (array_key_exists( $currentRoute[1], $routeDict )) {
    $actionsAllowed = $routeDict[$currentRoute[1]]['actions'];
    $controllerPath = $routeDict[$currentRoute[1]]['file'];

    // If the action is permitted, include the file.
    if (in_array( $action, $actionsAllowed )) {
        require_once( BASE_PATH . $controllerPath );
    }
    
    // Or send a 404.
    else {
        header( 'Location: ' . BASE_ADDRESS . '/404' );
        die();
    }
}
else {
    header( 'Location: ' . BASE_ADDRESS . '/404' );
    die();
}

?>