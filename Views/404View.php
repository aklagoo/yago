<?php

class View{
  public function __construct(){}
  public function generateHTML(){
    $html = "<div id='404div'><h2>Error 404</h2><h4>Page not found</h4></div>";
    return $html;
  }
}

?>
