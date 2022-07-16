<?php

    $html = "
    <form name='login' method='POST'>
      <div>
        <h4>Log In</h4>
        <input type='text' name='email' placeholder='User name' class='form-control'></input><br>
        <input type='password' name='password' placeholder='Password' class='form-control'></input><br>
        <p id='loginError'></p>
        <p>New to Website? <a href='http://localhost/Template/register'>Click here.</a></p>
        <button id='btnLogin' class='btn'>Submit</button>
      </div>
    </form>
    ";
    return $html;
  
?>
