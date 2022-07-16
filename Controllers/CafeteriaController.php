<?php
        //Extract cafeteria name
        $caf_search = $routes[2];
        
        //Check if it exists
        $caf_details = $model->SelectAllCaf($caf_search);

        if(count($caf_details)==0)
		{
            header("Location: /Yago/");
            die();
        }
    
        include_once('Includes/header.php');
        include_once('Includes/navbar.php');

        //Display menu
        $menu = $model->SelectAllFood($caf_details[0]['cafID']);

        //Display
        echo $view->generateHTML($caf_details[0], $menu);

        include_once('Includes/footer.php');
    


?>