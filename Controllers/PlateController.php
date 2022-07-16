<?php
        if($_POST['action']!='addToPlate')
		{
            die();
        }
        if(!isset($_SESSION['cart']))
		{
            $_SESSION['cart'] = array();
        }
        array_push($_SESSION['cart'], $_POST['foodID']);
        print_r($_SESSION['cart']);

?>