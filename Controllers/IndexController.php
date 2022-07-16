<?php
    $data = $model->generateData();
    include_once('Includes/header.php');
    include_once('Includes/navbar.php');
    $html = $view->generateHTML($data);
    echo $html;
    include_once('Includes/footer.php');
?>
