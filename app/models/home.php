<?php

require_once( BASE_PATH . '/includes/DatabaseEngine.php' );

class Model {
    public function __construct() {
        $this->engine = new DatabaseEngine();
    }
    public function selectAllItems() {
        $query  = "SELECT * FROM Food";
        $values = array();
        return $this->engine->executeQuery($query, $values, 1);
    }
}

return new Model();

?>