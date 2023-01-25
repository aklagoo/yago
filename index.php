<?php

session_start();

// Include important files
require_once( 'constants.php' );
$_ConfRoutes = require_once( BASE_PATH . '/config/routes.php' );


// Extract routes from the URL
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
$_GRoutes = generateRoutes();

/*===========================================================================
  The following section handles page access and redirection along with 404
  error pages.
  The code works on two main parts:
  1. Page name
  2. Action to be taken
  The page name is the page you want to access. For example, to access the
  login page, you'll write 'https://www.websitename.com/login'.
  The page name in this case is 'login'.
  The action means what the page is supposed to do. For example, 'login' has
  two actions:
  1. render : Display the page
  2. login  : Validate the user input and login if it is valid

  We have two types of pages:
  1. Pages that display(render) something (for eg., home, login and register)
  2. Pages that don't (pages like plate, which don't have anything to display)

  For the first type of page, if no action is specified, we assume that we're
  supposed to render. If it is specified, check if it is valid. Else,
  redirect to the 404 error page.

  For the second type, if no action is specified or if the action specified
  is not present, give a 404 error.
  =========================================================================*/

$action = ( isset($_POST['action']) ? $_POST['action'] : 'render');


if (array_key_exists( $_GRoutes[1], $_ConfRoutes )) {
    if (in_array( $action, $_ConfRoutes[$_GRoutes[1]]['actions'] )) {
        // Path exists, so include the required file
        require_once( BASE_PATH . $_ConfRoutes[$_GRoutes[1]]['file'] );
    }
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