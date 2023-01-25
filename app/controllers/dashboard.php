<?php

function removeNumericIndices($arr) {
    foreach ($arr as $key => $value) {
        if (is_int($key)) {
            unset($arr[$key]);
        }
    }
    return $arr;
}

if($action == 'render') {
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
    $model = include_once( BASE_PATH . '/models/dashboard.php' );
    $orders    = $model->selectAllOrders();
    $suborders = $model->selectAllSuborders();

    $ajaxResponse = array();
    $ajaxResponse['orders'] = array();
    $i = 0;
    $search = 0;

    foreach($orders as $row) {
        $orderID = $row['orderID'];

        // Add order to the response
        $row['suborders'] = array();
        array_push($ajaxResponse['orders'], removeNumericIndices($row));

        // Grab all suborders and shove them into the order row
        for($j=$search; $j<count($suborders); $j++) {
            if($suborders[$j]['orderID'] !== $orderID) {
                $search = $j;
                break;
            }
            array_push($ajaxResponse['orders'][$i]['suborders'], removeNumericIndices($suborders[$j]));
        }
        $i++;
    }

    $ajaxResponse['foodGroups'] = $model->selectFoodsByGroup();
    // Remove nested indices
    for($i=0; $i<count($ajaxResponse['foodGroups']); $i++) {
        $ajaxResponse['foodGroups'][$i] = removeNumericIndices($ajaxResponse['foodGroups'][$i]);
    }

    echo json_encode($ajaxResponse);
}
elseif($action == 'paid') {
    if(isset($_POST['orderID'])) {
        $model = include_once( BASE_PATH . '/models/dashboard.php' );
        $model->setPaid($_POST['orderID']);
        echo 0;
    }
    echo 1;
}
elseif($action == 'modify') {
    if(isset($_POST['suborderID']) && isset($_POST['modifier'])) {
        if($_POST['modifier'] == '+1' || $_POST['modifier'] == '-1'){
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
        return 1;
    }
    return 1;
}

?>