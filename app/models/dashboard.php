<?php

require_once( BASE_PATH . '/includes/DatabaseEngine.php' );

class Model {
    private $engine;
    public function __construct() {
        $this->engine = new DatabaseEngine();
    }
    public function selectAllSuborders() {
        $query  = "SELECT Suborder.subID as subID, Suborder.foodID as foodID, Suborder.orderID as orderID, Suborder.total as total, Suborder.paid as paid, Suborder.collected as collected, Suborder.quantity as quantity, Suborder.prepared as prepared, Food.name as name FROM Suborder INNER JOIN Food ON Suborder.foodID = Food.foodID WHERE (Suborder.paid<Suborder.quantity or Suborder.collected<Suborder.quantity) AND Suborder.orderID IN (SELECT orderID FROM CafOrder WHERE 
        prepared<quantity OR collected<quantity OR paid=0) ORDER BY orderID;";
        $values = array();
        return $this->engine->executeQuery($query, $values, 1);
    }
    public function selectAllOrders() {
        $query  = "SELECT * FROM CafOrder WHERE prepared<quantity OR collected<quantity OR paid=0 ORDER BY orderID";
        $values = array();
        return $this->engine->executeQuery($query, $values, 1);
    }
    public function setOrdersLoadedTrue() {
        $query  = "UPDATE CafOrder SET loaded=1 WHERE loaded=0";
        $values = array();
        return $this->engine->executeQuery($query, $values, 0);
    }
    public function selectFoodsByGroup() {
        $query  = "SELECT Suborder.foodID as FoodID, Food.name as name, sum(Suborder.quantity) as quantity FROM
        Suborder INNER JOIN Food ON Suborder.foodID=Food.foodID WHERE Suborder.orderID IN (SELECT orderID FROM CafOrder WHERE prepared<quantity OR collected<quantity OR paid=0 ORDER BY orderID) GROUP BY foodID";
        $values = array();
        return $this->engine->executeQuery($query, $values, 1);
    }
    public function setPaid($orderID) {
        $query  = "UPDATE CafOrder SET paid=1 WHERE orderID=?";
        $values = array($orderID);
        return $this->engine->executeQuery($query, $values, 0);
    }
    public function modifyCollectedSuborder($subID, $modifier) {
        $query  = "UPDATE Suborder SET collected = collected " . ($modifier=='+1'?' + 1 ' :' -  1') . " WHERE subID=?";
        $values = array($subID);
        return $this->engine->executeQuery($query, $values, 0);
    }
    public function modifyPreparedSuborder($subID, $modifier) {
        $query  = "UPDATE Suborder SET prepared = prepared" . ($modifier=='+1'?' + 1 ' :' -  1') . " WHERE subID=?";
        $values = array($subID);
        return $this->engine->executeQuery($query, $values, 0);
    }
}

return new Model();

?>