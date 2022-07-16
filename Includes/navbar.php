<nav id='mobile-nav'>
<table id='nav-table'>
<tr>
<td id='tdHamburgerMob'><img id='hamburger' class='icon-sm' src='http://localhost/Yago/img/hamburger.svg'/></td>
<td id='tdLogoMob'><a href='http://localhost/Yago/'><img id='logo' class='icon-sm' src='http://localhost/Yago/img/logo_mobile.svg'></img></a></td>
<td id='tdSearchMob'><img id='search' class='icon-sm' src='http://localhost/Yago/img/search.svg'/></td>
<tr>
</table>
</nav>

<nav id='web-nav'>
<table id='nav-table'>
  <tr>
    <td id='tdLogo'><a href='http://localhost/Yago/'><img id='logo' class='icon-bg' src='http://localhost/Yago/img/logo_web.svg'></img></a></td>
    <td id='tdSearchbar'><input type='text' id='searchText'/></td>
    <td id='tdSearch'><img id='search' class='icon-sm' src='http://localhost/Yago/img/search.svg'/></td>
    <td id='tdCart'><div id='plateButton' class='navButton'>Plate <img id='plateDropdown' class='icon-sm' src='http://localhost/Yago/img/plate.svg'/></div>
    <div id='accountButton' class='navButton'>Account <img id='accountDropdown' class='icon-sm' src='http://localhost/Yago/img/person.svg'/></div></td>
  </tr>
</table>
</nav>

<div id='account-modal'>
<div id='account-modal-content'>

<?php

if(!isset($_SESSION['USER_DETAILS'])){
  $html = "
  <img id='logo' class='icon-xbg' src='http://localhost/Yago/img/logo_mobile.svg'/>
  <h3>Sign In</h3>
  <form name='signin' method='post'>
  <input type='email' name='email' placeholder='Email' class='form-input'/>
  <input type='password' name='password' placeholder='Password' class='form-input'/>
  <div class='form-switch'><p id='userSelect' class='switch-p switch-selected'>User</p><p id='cafeteriaSelect' class='switch-p switch-not-selected'>Cafeteria</p></div>
  <button id='signIn' onclick='return false;' class='form-button-primary'>Sign In</button>
  <p class='text-small'>Don't have an account? <a href='register'>Sign up.</a></p>
  </form>
  ";
}
else{
  $html = "<h3>Details</h3><button id='signOut' onclick='return false;' class='form-button-primary'>Sign Out</button>";
}
echo $html;

?>

</div>
</div>
