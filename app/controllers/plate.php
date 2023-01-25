<?php

$model = require_once( BASE_PATH . '/models/plate.php' );

if($_POST['action'] == 'add'){
    if( !isset( $_POST['foodID'] ) ) {
        return -1;
        die();
    }

    if(!isset($_SESSION['plate'])){
        $_SESSION['plate'] = array();
    }

    // Check if element already
    $result = 0;
    for( $i=0; $i < count( $_SESSION['plate'] ); $i++ ) {
        if( $_SESSION['plate'][$i]['foodID'] == $_POST['foodID'] ) {
            $_SESSION['plate'][$i]['quantity'] += 1;
            $result++;
            break;
        }
    }
    if($result) {
        echo 0;
        die();
    }

    $row = $model->selectFoodByID($_POST['foodID']);
    if(count( $row )==0) {
        echo -1;
    }
    else {
        $row['quantity'] = 1;
        $row['total'] = $row['cost'] * $row['quantity'];
        $_SESSION['plate'][] = $row;
        echo 0; 
    }
}

elseif($_POST['action'] == 'set') {
    if(!isset($_POST['foodID']) || !isset($_POST['quantity'])) {
        return -1;
        die();
    }
    $result = -1;
    for( $i=0; $i < count( $_SESSION['plate'] ); $i++ ) {
        if( $_SESSION['plate'][$i]['foodID'] == $_POST['foodID'] ) {
            $_SESSION['plate'][$i]['quantity'] = ( (int) $_POST['quantity'] < 0 ? 0 : (int) $_POST['quantity'] );
            $_SESSION['plate'][$i]['total'] = $_SESSION['plate'][$i]['quantity'] * 3;
            if( $_SESSION['plate'][$i]['quantity'] == 0 ) {
                array_splice($_SESSION['plate'],$i, $i+1);
            }
            $result++;
            break;
        }
    }
    echo $result;

}
elseif ($_POST['action']=='placeOrder') {
    if(!isset($_SESSION['USER_DETAILS'])){
        echo 1;
        $_SESSION['plate'] = array();
        die();
    }
    // Insert data
    $model->insertOrderAndSuborder($_SESSION['USER_DETAILS']['custID'], count($_SESSION['plate']), $_SESSION['plate']);
}
elseif($_POST['action']=='fetchPlate') {
    echo json_encode($_SESSION['plate']);
}

?>