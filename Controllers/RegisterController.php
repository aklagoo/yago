<?php
    $action = 'render';
  
    if(isset($_POST['action']))
	{
      if($_POST['action']=='userRegister')
	  {
        $action = 'userRegister';
      }
    }
    //Check if user has logged in or not
    if(isset($_SESSION['USER_DETAILS']))
	{
      header('Location: /');
      die();
    }
    if($action=='render')
	{
        include_once('Includes/header.php');
        //$html = $view->generateUserHTML();
        echo $html;
        include_once('Includes/footer.php'); 
    }
    if($action=='userRegister')
	{
      $result = $model->userValidate($_POST['fName'], $_POST['lName'], $_POST['email'], $_POST['mobile'], $_POST['password']);
      echo $result;
      return;
    }
?>
