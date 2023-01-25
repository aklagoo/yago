<nav>
<button class='button-round nav-button plate-modal-trigger'><?php echo "<img src='".BASE_ADDRESS."/public/img/plate.svg'></img>";?></button>
<?php
if(isset($_SESSION['USER_DETAILS'])){
    echo "<button class='button-round nav-button logout-trigger'>";
    echo "<img src='".BASE_ADDRESS."/public/img/logout.svg'></img></button>";
}
else {
    echo "<button class='button-round nav-button login-trigger'>";
    echo "<img src='".BASE_ADDRESS."/public/img/person.svg'></img></button>";
}
?>
</nav>