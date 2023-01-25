<?php
include_once( BASE_PATH . '/includes/header.php' );
include_once( BASE_PATH . '/includes/navbar.php');
include_once( BASE_PATH . '/includes/plateDiv.php' );
?>

<?php echo "<script src='" . BASE_ADDRESS . "/public/js/plate.js'></script>"; ?>

<main>

<div class='banner'>
    <?php echo "<img class='banner-img' src='". BASE_ADDRESS . "/public/img/banner.svg'></img>"; ?>
</div>

<!--- Entire menu --->
<div class='menu'>
<h1>Menu</h1>
<table class='menu__table'>
<tr><th>Name</th><th>Cost</th><th>Buy</th></tr>

<?php

foreach ($pageDetails->menu as $row) {
    echo "<tr class='menu__table-row'><td>" . $row['name'] . "</td>
    <td>Rs. " . $row['cost'] . "</td><td>
    <button class='button-round buy-btn' id='" . $row['foodID'] .
    "'>+</button></td>";
}

?>

</table>
</div>

</main>

<?php include_once( BASE_PATH . '/includes/footer.php' ); ?>