<?php

function removeNumericIndices($arr) {
    /**
     * Utility function removing all numbers from an array for simplifying
     * queries results.
     */
    foreach ($arr as $key => $value) {
        if (is_int($key)) {
            unset($arr[$key]);
        }
    }
    return $arr;
}

if($action == 'render') {
    /**
     * Check if the user has logged in with the cafeteria user role. If not
     * logged in, redirect them to '/login'. If they have logged in but
     * as a customer, redirect them to the customer menu page at '/'.
     */
    if(!isset($_SESSION['USER_DETAILS'])){
        header("Location: " . BASE_ADDRESS . "/login");
        die();
    }
    if($_SESSION['USER_TYPE']!='cafeteria') {
        header("Location: " . BASE_ADDRESS);
        die();
    }
    include_once( BASE_PATH . '/views/dashboard.php' );
}

elseif($action == 'fetchAll') {
    // Load all orders for the current user.
    $model = include_once( BASE_PATH . '/models/dashboard.php' );
    $orders    = $model->selectAllOrders();
    $suborders = $model->selectAllSuborders();

    $response = array();
    $response['orders'] = array();
    $i = 0;
    $search = 0;

    foreach($orders as $row) {
        $orderID = $row['orderID'];

        // Add order to the response
        $row['suborders'] = array();
        array_push($response['orders'], removeNumericIndices($row));

        /**
         * Since suborders are sorted by orderID, sequentially iterate and
         * append until a mismatch is found. 
         */
        for($j=$search; $j<count($suborders); $j++) {
            if($suborders[$j]['orderID'] !== $orderID) {
                $search = $j;
                break;
            }
            array_push($response['orders'][$i]['suborders'],
                removeNumericIndices($suborders[$j]));
        }
        $i++;
    }

    $response['foodGroups'] = $model->selectFoodsByGroup();

    // Remove nested indices
    for($i=0; $i<count($response['foodGroups']); $i++) {
        $response['foodGroups'][$i] = removeNumericIndices($response['foodGroups'][$i]);
    }

    echo json_encode($response);
}

elseif($action == 'paid') {
    // Mark order as paid.
    if(isset($_POST['orderID'])) {
        $model = include_once( BASE_PATH . '/models/dashboard.php' );
        $model->setPaid($_POST['orderID']);
        echo 0;
    }
    echo 1;
}

elseif($action == 'modify') {
    // Fail if the suborder ID or modifier are not present.
    if(!isset($_POST['suborderID']) || !isset($_POST['modifier'])) {
        return 1;
    }
    // Fail if the modifier is neither '+1' nor '-1'.
    if($_POST['modifier'] != '+1' || $_POST['modifier'] != '-1') {
        return 1;
    } 
    
    // Load the model and perform the update.
    $model = include_once( BASE_PATH . '/models/dashboard.php' );
    if($_POST['type']=='collected' || $_POST['type'] == 'prepared'){
        if($_POST['type']=='collected') {
            $model->modifyCollectedSuborder($_POST['suborderID'], $_POST['modifier']);
        }
        else{
            $model->modifyPreparedSuborder($_POST['suborderID'], $_POST['modifier']);
        }
        return 0;
    }
}

?>