<?php

return array(
    '' => array(
        'file'    => '/controllers/home.php',
        'actions' => array('render')
    ),
    '404' => array(
        'file'    => '/views/404.php',
        'actions' => array('render')
    ),
    'login' => array(
        'file'    => '/controllers/login.php',
        'actions' => array('render', 'login', 'logout')
    ),
    'register' => array(
        'file'    => '/controllers/register.php',
        'actions' => array('render', 'register'),
    ),
    'plate' => array(
        'file'    => '/controllers/plate.php',
        'actions' => array('add', 'set', 'placeOrder', 'fetchPlate')
    ),
    'dashboard' => array(
        'file'    => '/controllers/dashboard.php',
        'actions' => array('render', 'fetchAll', 'modify', 'paid')
    )
);

?>