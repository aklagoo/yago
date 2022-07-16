<?php
    $action = 'render';
  
    if(isset($_POST['action']))
	{
      if($_POST['action']=='signIn')
	  {
        $action = 'signIn';
      }
      if($_POST['action']=='signOut')
	  {
        $action = 'signOut';
        unset($_SESSION['USER_DETAILS']);
        return 1;
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
      //$html = $view->generateHTML();
      echo $html;
      include_once('Includes/footer.php');
    }
    if($action=='signIn')
	{
		
      $result = $model->signIn($_POST['user'], $_POST['password'], $_POST['type']);
      echo $result;
    }
?>
