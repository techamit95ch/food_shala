<?php
$rest=false;
if (isset($_SESSION["type"]) && $_SESSION["type"]=='rest') $rest=true;
$logged_in =0;

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    $logged_in =1;
    // if (isset($_SESSION["type"]))echo $_SESSION['type'];
    // die();
}
?>

<div class="jumbotron">
      <div class="container text-center">
          <h1>Food Shala</h1>
          <p>Give Good Food From Best Local Resturants</p>
      </div>
  </div>

  <nav class="navbar navbar-inverse">
      <div class="container-fluid">
          <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                  <li class="active"><a href="./">Home</a></li>
                  <?php
                    if ($rest){
                  ?>
                  <li class="active"><a href="./addmenu">Add Menu</a></li>
                  <li class="active"><a href="./view_orders">View Orders</a></li>
                  <li class="active"><a href="./menu">View Menu</a></li>
                  <?php
                    }
                  ?>


              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <?php
                  if ($logged_in==1){
                      ?>
                      <li><a href="logout"><span class="glyphicon glyphicon-user"></span> Logout</a></li>

                      <?php
                  }else{
                  ?>
                  <li><a href="login"><span class="glyphicon glyphicon-user"></span> Login</a></li>

                  <?php
                      }
                  ?>

                  <!-- <li><a href="#"> -->
                  <!--  <span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li> -->
              </ul>
          </div>
      </div>
  </nav>
