<?php

class Controller{
  public function __construct($model, $view, $identity, $routes){
    $this->model = $model;
    $this->view = $view;
  }

  public function run(){
    include_once('Includes/header.php');
    $html = $this->view->generateHTML();
    echo $html;
    include_once('Includes/footer.php');
  }
}

?>
