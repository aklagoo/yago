<?php

class View{
  public function __construct(){}
  public function generateHTML($data, $menu){
    $html = "
    <script src='/Yago/js/cafeteria.js'></script>
    <main>
    
    <div class='banner'>
    <h3>".$data["cafName"]."</h3>
    <p>".$data["cafAddress"]."</p>
    </div>

    <div class='description'>
    <h4>Description</h4>
    <p>".$data["cafDescription"]."</p>
    </div>

    <div class='menu'>
    <table>
    ";
    $rows = "";
    foreach($menu as $row) {
        $rows = $rows."<tr><td>".$row['name']."</td><td>".$row['cost']."</td><td><button class='buy-btn' id='".$row['foodID']."'>Buy</button></td></tr>";
    }
    $html = $html.$rows;
    $html = $html."
    </table>
    </div>

    </main>
    ";
    return $html;
  }
}

?>