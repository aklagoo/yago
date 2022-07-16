<?php

class View{
  public function __construct(){}
  public function generateHTML($data){
    $html = "<p>".$data."</p>";
    return $html;
  }
}

?>
