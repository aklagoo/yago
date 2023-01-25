<?php

/*===========================================================================
  HOME PAGE
  The page displays two main tabs: menu and about.

  1. Menu
  The menu itself has two sections: favourites, recently ordered and the
  complete menu.
  The favorites can be stored only with an account.
  Recently ordered items can be stored in cookies.
  The complete menu is displayed normally with a normal SELECT * command.

  2. About
  The page contains a profile image, title, description, rating and the
  address.

  =========================================================================*/

$model = require_once( BASE_PATH . '/models/home.php' );

$pageDetails = new stdClass();

$pageDetails->loggedIn  = isset( $_SESSION['login'] );
$pageDetails->cookieSet = isset( $_COOKIE['recent'] );
$pageDetails->menu      = $model->selectAllItems();

include_once( BASE_PATH . '/views/home.php' );

?>