<div class='modal plate-modal'>
<p class='close-plate-modal'>✕</p>
<div class='plate-div modal-content' style="display:none;">

<?php
/*
if(isset($_SESSION['plate'])) {
    print_r($_SESSION);
    if ( count($_SESSION['plate']) !== 0 ) {
        echo "<table class='plate-table'>";
        $sum = 0;
        $i = 1;
        foreach ($_SESSION['plate'] as $row) {
            $sum = $sum + (int) $row['cost'] * (int) $row['quantity'];
            // Display each item with modify options
            $row = "
            <tr>
            <td>" . $row['name'] . "</td>
            <td>Rs. " . $row['cost'] . "</td>
            <td>" . $row['quantity'] . "</td>
            <td><button class='button-round incQty'  id='" . $row['foodID'] . "'>+</button></td>
            <td><button class='button-round decQty'  id='" . $row['foodID'] . "'>-</button></td>
            <td><button class='button-round delItem' id='" . $row['foodID'] . "'>x</button></td>
            </tr>
            ";
            echo $row;
        }
        echo "<tr><th id='total'>Total</th><td colspan=2>Rs. ".$sum."</td></tr></table><button class='button-primary' id='placeOrder'>Place order</button>";
    }
    else {
        echo "No items added";
    }
}
else {
    echo "No items added";
}
*/
?>

</div>
</div>