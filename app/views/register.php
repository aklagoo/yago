<?php
    echo "<script src='".BASE_ADDRESS."/public/js/register.js'></script>";
    $html = "
    <form name='user_register' class='self-center' id='account-modal-content' method='POST'><div class='user-register-div'>
    <h3>Register</h3>
      <label class='form-label'>First Name</label>
      <input name='fName' type='text' class='form-input'></input><p id='fNameError' class='text-danger'></p>
      <label class='form-label'>Last Name</label>
      <input name='lName' type='text' class='form-input'></input><p id='lNameError' class='text-danger'></p>
      <label class='form-label'>Email</label>
      <input name='email' type='text' class='form-input'></input><p id='emailError' class='text-danger'></p>
      <label class='form-label'>Mobile</label>
      <input name='mobile' type='text' class='form-input'></input><p id='mobileError' class='text-danger'></p>
      <label class='form-label'>Password</label>
      <input name='password' type='password' class='form-input'></input><p id='passwordError' class='text-danger'></p>
      <button id='btnRegister' class='form-button-primary'>Submit</button>
    </div></form>
    ";
    echo $html;
?>
