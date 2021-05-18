<?php
require_once "lib/config.php";
$logged_in =0;

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    $logged_in =1;
    // if (isset($_SESSION["type"]))echo $_SESSION['type'];
    // die();
}
// die($logged_in);
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
                        <h2>Popular Veg Foods</h2>
                    </div>
                </div>
            </br>
                <?php
                if (isset($_SESSION["type"])&& $_SESSION["type"]=='rest') {
                    $sql = "SELECT * FROM menu WHERE res_id = :res_id AND `type`='veg'";
                    if($stmt = $pdo->prepare($sql)){
                        $stmt->bindParam(":res_id", $_SESSION['id'], PDO::PARAM_INT);
                    }
                }else{
                    $sql = "SELECT * FROM menu where  `type`='veg'";
                    
                    $stmt = $pdo->prepare($sql);
                        
                }
                if($stmt->execute()){
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) {

                ?>
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <a href="view_menu?id=<?php echo $row['id']; ?>">
                        <div class="panel-heading"><?php echo $row['name'];?></div>
                        <div class="panel-body"><img src="<?php echo $row['image'];?>" class="img-responsive" style="height: 280px;
    width: 100%;"
                                alt="Image">
                        </div>
                        <div class="panel-footer">Rs. <?php echo $row['price'];?>/-</div>
                        </a>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    <div class="row">
        
    
            <div class="col-sm-12">
                <div class="jumbotron">
                    <div class="container text-center">
                        <h2>Popular Non-Veg Foods</h2>
                    </div>
                </div>
            </br>
                <?php
                if (isset($_SESSION["type"])&& $_SESSION["type"]=='rest') {
                    $sql = "SELECT * FROM menu WHERE res_id = :res_id AND `type`='nonveg'";
                    if($stmt = $pdo->prepare($sql)){
                        $stmt->bindParam(":res_id", $_SESSION['id'], PDO::PARAM_INT);
                    }
                }else{
                    $sql = "SELECT * FROM menu WHERE `type`='nonveg'";
                    
                    $stmt = $pdo->prepare($sql);
                        
                }
                if($stmt->execute()){
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) {

                ?>
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <a href="view_menu?id=<?php echo $row['id']; ?>">
                        <div class="panel-heading"><?php echo $row['name'];?></div>
                        <div class="panel-body"><img src="<?php echo $row['image'];?>" class="img-responsive" style="height: 280px;
    width: 100%;"
                                alt="Image">
                        </div>
                        <div class="panel-footer">Rs. <?php echo $row['price'];?>/-</div>
                        
                        </a>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div><br>
    
    <br><br>

    <footer class="container-fluid text-center">
        <p>Food Shala</p>

        <!-- <form class="form-inline">Get deals: -->
        <!-- <input type="email" class="form-control" size="50" placeholder="Email Address"> -->
        <!-- <button type="button" class="btn btn-danger">Sign Up</button> -->
        <!-- </form> -->
    </footer>

</body>

</html>
