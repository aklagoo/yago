<?php
require_once(BASE_PATH . '/includes/DatabaseEngine.php');

class Model{
  public function __construct(){
    $this->engine = new DatabaseEngine();
    $this->hashOptions = ['cost' => 12];
  }
  public function userValidate($fName, $lName, $email, $mobile, $password){
    $status = 0;

    $fetchEmail = "SELECT COUNT(*) AS count FROM Customer WHERE email=?";
    $values = array($email);
    $result = $this->engine->executeQuery($fetchEmail, $values, 1);
    if($result[0]['count']>0){
      $status = $status + 1;
    }

    $fetchMobile = "SELECT COUNT(*) AS count FROM Customer WHERE mobile=?";
    $values = array($mobile);
    $result = $this->engine->executeQuery($fetchMobile, $values, 1);
    if($result[0]['count']>0){
      $status = $status + 2;
    }

    if($status==0){
      $insertUserQuery = "INSERT INTO Customer (fName, lName, email, mobile, password) VALUES (?,?,?,?,?)";
      $values = array($fName, $lName, $email, $mobile, $password);
      // $values = array($fName, $lName, $email, $mobile, password_hash($password, PASSWORD_DEFAULT, $this->hashOptions));
      $result = $this->engine->executeQuery($insertUserQuery, $values, 0);
    }
    return $status;
  }
  public function cafeteriaValidate($fName, $lName, $email, $mobile, $username, $password, $cafName, $address, $description) {
    $insertCafeteriaQuery = "INSERT INTO Cafeteria(ownFName, ownLName, ownEmail, ownMobile, cafUsername, cafPassword, cafName, cafAddress, cafDescription) VALUES (?,?,?,?,?,?,?,?,?)";
    $values = array($fName, $lName, $email, $mobile, $username, $password, $cafName, $address, $description);
    $result = $this->engine->executeQuery($insertCafeteriaQuery, $values, 0);
  }
}

return new Model();

?>
