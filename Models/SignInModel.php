<?php

require_once('Includes/DatabaseEngine.php');

class Model{
  public function __construct(){
    $this->engine = new DatabaseEngine();
  }
  public function signIn($user, $password, $type){
    $query = 'SELECT * FROM '.($type=='user'?'customer':'cafeteria').' WHERE '.($type=='user'?'email':'cafUsername').'=?';
    $values = array($user);

    $result = $this->engine->executeQuery($query, $values, 1);
    if(empty($result)){
      return 0;
    }
    $key = $type=='user'?'password':'cafPassword';
    // if(password_verify($password, $result[0]['email'])){
    if($password===$result[0][$key]){
      $_SESSION['USER_DETAILS'] = $result[0];
      $_SESSION['USER_TYPE'] = $type;
      return 2;
    }
    else {
      return 1;
    }
  }
}

?>
