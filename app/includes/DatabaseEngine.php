<?php

class DatabaseEngine{
  private $connection;
  public function __construct(){
    $host=$_ENV["DB_HOST"];
    $dbname = $_ENV["DB_NAME"];
    $username = "root";
    $password = $_ENV["DB_PASSWORD"];
    try{
      $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
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
