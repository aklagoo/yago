<?php

class DatabaseEngine{
  public function __construct(){
    $dbname = "";
    $username = "";
    $password = "";
    try{
      $this->connection = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function executeQuery($query, $values, $isRead){
    $statement = $this->connection->prepare($query);
    $status = $statement->execute($values);
    if($isRead){
      return $statement->fetchAll();
    }
    else{
      return $status;
    }
  }
}

?>
