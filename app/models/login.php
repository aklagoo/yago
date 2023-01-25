<?php

require_once(BASE_PATH.'/includes/DatabaseEngine.php');

class Model{
  public function __construct(){
    $this->engine = new DatabaseEngine();
  }
  public function signIn($user, $password, $type){
    $query = 'SELECT * FROM '.($type=='user'?'Customer':'Cafeteria').' WHERE '.($type=='user'?'email':'cafUserName').'=?';
    $values = array($user);

    $result = $this->engine->executeQuery($query, $values, 1);
    echo $values[1];
    if(empty($result)){
      echo 0;
      return;
    }
    $key = $type=='user'?'password':'cafPassword';
    // if(password_verify($password, $result[0]['email'])){
    if($password===$result[0][$key]){
      $_SESSION['USER_DETAILS'] = $result[0];
      $_SESSION['USER_TYPE'] = $type;
      echo 2;
    }
    else {
      echo 1;
    }
  }
}
return new Model();

?>
