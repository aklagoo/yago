<?php echo "<script src='".BASE_ADDRESS."/public/js/global.js'></script>"; ?>
<main class='login-background'>
<div id='account-modal-content'>
  <h3>Sign In</h3>
  <form name='signin' method='post'>
  <input type='email' name='email' placeholder='Email' class='form-input'/>
  <input type='password' name='password' placeholder='Password' class='form-input'/>
  <div class='form-switch'><p id='userSelect' class='switch-p switch-selected'>User</p><p id='cafeteriaSelect' class='switch-p switch-not-selected'>Cafeteria</p></div>
  <button id='signIn' onclick='return false;' class='form-button-primary'>Sign In</button>
  <p class='text-small'>Don't have an account? <a href='register'>Sign up.</a></p>
  </form>
  </div>
</main>