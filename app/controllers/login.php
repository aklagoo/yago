<?php
    if($action=='login')
	{
      $model = require_once( BASE_PATH . '/models/login.php');
      $result = $model->signIn($_POST['user'], $_POST['password'], $_POST['type']);
    }
    elseif($action=='logout')
	{
      if(isset($_SESSION['USER_DETAILS'])){
          unset($_SESSION['USER_DETAILS']);
          echo 0;
      }
      else{
          echo 1;
      }
    }
    elseif($action=='render')
	{
    if(isset($_SESSION['USER_DETAILS'])){
        header('Location: ' . BASE_ADDRESS);
        die();
    }
      include_once( BASE_PATH . '/includes/header.php');
      include_once( BASE_PATH . '/views/login.php');
      include_once( BASE_PATH . '/includes/footer.php');
    }
?>
