<?php
$model = require_once(BASE_PATH . '/models/register.php');

//Check if user has logged in or not
if(isset($_SESSION['USER_DETAILS']))
{
    header('Location: '.BASE_ADDRESS);
    die();
}
if($action=='render')
{
    include_once(BASE_PATH . '/includes/header.php');
    include_once(BASE_PATH . '/views/register.php');
    include_once(BASE_PATH . '/includes/footer.php'); 
}
if($action=='register')
{
    $result = $model->userValidate($_POST['fName'], $_POST['lName'], $_POST['email'], $_POST['mobile'], $_POST['password']);
    echo $result;
    return;
}
?>
