<?php

require_once( BASE_PATH . '/includes/DatabaseEngine.php' );

class Model {
    private $engine;
    public function __construct() {
        $this->engine = new DatabaseEngine();
    }
    public function selectFoodByID($foodID) {
        $query  = "SELECT * FROM Food WHERE foodID = ?";
        $values = array($foodID);
        return $this->engine->executeQuery($query, $values, 1)[0];
    }
    public function insertOrderAndSuborder($orderedBy, $quantity, $suborders) {
        $query  = "SELECT MAX(orderID) FROM CafOrder";
        $values = array();
        $id = $this->engine->executeQuery($query, $values, 1)[0]['MAX(orderID)'];
        $id = (int)$id + 1;
        
        $query  = "INSERT INTO CafOrder(orderID, orderedBy, quantity) VALUES(?,?,?)";
        $values = array($id, $orderedBy, $quantity);
        $x = $this->engine->executeQuery($query, $values, 0);
        
        foreach($suborders as $row) {
            $query  = "INSERT INTO Suborder(foodID, orderID, quantity, total) VALUES (?,?,?,?) ";
            $values = array($row['foodID'], $id, $row['quantity'], $row['total']);
            $x = $this->engine->executeQuery($query, $values, 0);
        }
    }
}

return new Model();

?>