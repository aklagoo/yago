<?php

require_once(BASE_PATH.'/includes/DatabaseEngine.php');

class Model{
  private $engine;
  public function __construct(){
    $this->engine = new DatabaseEngine();
  }
  public function signIn($user, $password, $type){
    /**
     * Authenticates user details.
     */

    $query = 'SELECT * FROM '.($type=='user'?'Customer':'Cafeteria').' WHERE '.($type=='user'?'email':'cafUserName').'=?';
    $values = array($user);

    $result = $this->engine->executeQuery($query, $values, 1);
    echo $values[1];
    if(empty($result)){
      echo 0;
      return;
    }
    $key = $type=='user'?'password':'cafPassword';
    
    // If successful, save user details to the username.
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
