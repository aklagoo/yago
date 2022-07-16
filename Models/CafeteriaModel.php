<?php

require_once('Includes/DatabaseEngine.php');

class Model {
    public function __construct() {
        $this->engine = new DatabaseEngine();
    }
    public function SelectAllCaf($search){
        $query = "SELECT * FROM cafeteria WHERE cafUserName = ?";
        $values = array($search);
        $result = $this->engine->executeQuery($query, $values, 1);

        return $result;
    }
    public function SelectAllFood($cafID) {
        $query = "SELECT * FROM Food WHERE ServedBy=?";
        $values = array($cafID);
        $result = $this->engine->executeQuery($query, $values, 1);

        return $result;
    }
}

?>