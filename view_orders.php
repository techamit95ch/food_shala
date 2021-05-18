<?php
require_once "lib/config.php";
// die($logged_in);
//  $sql ="SELECT * FROM `order` WHERE res_id= :res_id and status = 0 ";
//  
if (isset($_GET['done'])){
    $sql ="UPDATE `order` SET `status` =1 WHERE `id` =:id";
    if($stmt = $pdo->prepare($sql)){                        
                        $stmt->bindParam(":id", $_GET['done'], PDO::PARAM_INT);
                        if($stmt->execute()){
                                echo "<script>alert('Order Delivered Successfully');</script>";
                        }
                    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Food Shala</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */
    .navbar {
        margin-bottom: 50px;
        border-radius: 0;
    }

    /* Remove the jumbotron's default bottom margin */
    .jumbotron {
        margin-bottom: 0;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
        background-color: #f2f2f2;
        padding: 25px;
    }
    </style>
</head>

<body>

    <?php
        require_once "lib/navbar.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="jumbotron">
                    <div class="container text-center">
                        <h2>All Foods</h2>
                    </div>
                </div>
                <br />

                <?php
                $sql ="SELECT * FROM `order` WHERE res_id= :res_id and status = 0 ";
                if($stmt = $pdo->prepare($sql)){                        
                        $stmt->bindParam(":res_id", $_SESSION["id"], PDO::PARAM_INT);
                        if($stmt->execute()){

                            $result = $stmt->fetchAll();

                            ?>
                            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer</th>
      <th scope="col">Menu</th>
      <th scope="col">Address</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ct = 1;
    foreach ($result as $row) {
    ?>
    <tr>
      <th scope="row"><?php echo $ct;?></th>
      <td><?php
      $sql1 = "SELECT * FROM users WHERE  id = :user_id";
      if ($stmt = $pdo->prepare($sql1)){
        $stmt->bindParam(":user_id", $row["user_id"], PDO::PARAM_INT);
        $stmt->execute();
        $row1 = $stmt->fetch(); 
        echo $row1['name'];
        }
      ?></td>
      <td><?php 
      $sql2 = "SELECT * FROM menu WHERE  id =:menu_id";
      if ($stmt = $pdo->prepare($sql2)){
        $stmt->bindParam(":menu_id", $row["menu_id"], PDO::PARAM_INT);
        $stmt->execute();
        $row2 = $stmt->fetch(); 
        echo $row2['name'];
    }
      ?></td>
      <td><?php echo $row1['address'];?></td>
      <td><a href="view_orders?done=<?php echo $row['id'];?>"> Not Done</a></td>
    </tr>
    <?php
    $ct++;
            }

    ?>
  </tbody>
</table>
                            <?php
                        }
                    }
                ?>

                
                <div>
                    
                </div>
        
                                    
                                        
            
                
            </br>
            </div>
        </div>
    </div><br>

    <footer class="container-fluid text-center">
        <p>Food Shala</p>

        <!-- <form class="form-inline">Get deals: -->
        <!-- <input type="email" class="form-control" size="50" placeholder="Email Address"> -->
        <!-- <button type="button" class="btn btn-danger">Sign Up</button> -->
        <!-- </form> -->
    </footer>

</body>

</html>
