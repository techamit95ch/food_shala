<?php
require_once "lib/config.php";
if(!isset($_SESSION["cart"])){
        $_SESSION["cart"]= [];
    }
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset( $_GET['id'])) array_push($_SESSION['cart'], $_GET['id']);
// }else{
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset( $_GET['id'])) array_push($_SESSION['cart'], $_GET['id']);
    
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset( $_GET['remove'])) unset($_SESSION['cart'][$_GET['remove']]);

    $_SESSION['cart']=array_unique($_SESSION['cart']);






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
                        <h2>All Cart</h2>
                    </div>
                </div>
                <br />
                
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" || isset($_SESSION["cart_logged_in"])){

        if(isset($_POST['save_order']) || isset($_SESSION["cart_logged_in"])){
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
                header("location: login");
            }else{
                foreach ($_SESSION['cart'] as $menu_id) {

                    $sql = "SELECT * FROM menu WHERE id = :id";
             if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":id", $menu_id, PDO::PARAM_INT);
                if($stmt->execute()){
                    $result = $stmt->fetch();
                }


                    # code...
                    $sql= "INSERT INTO `order` (menu_id, user_id,res_id) values (:menu_id,:user_id,:res_id)";
                    
                    if($stmt = $pdo->prepare($sql)){

                        $stmt->bindParam(":menu_id", $menu_id, PDO::PARAM_INT);
                        $stmt->bindParam(":user_id", $_SESSION["id"], PDO::PARAM_INT);
                        $stmt->bindParam(":res_id", $result['res_id'], PDO::PARAM_INT);
                        if($stmt->execute()){

                            $_SESSION["cart"]= [];

                            if (isset($_SESSION["cart_logged_in"]))unset($_SESSION["cart_logged_in"]);
                            echo "<script> 
                                alert('Successfully Order Placed');
                                window.location = './';

                            </script>";
                            // header("location: ./");
                            }       
                    }

                }
                
            }
        }   
    }
}
        $total = 0;
        foreach ($_SESSION['cart'] as $key=> $id ) {
            # code...
        
             $sql = "SELECT * FROM menu WHERE id = :id";
             if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                if($stmt->execute()){
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) {
                        $total+=$row['price'];
                        ?>
                        <div class="col-sm-4">
                        <div class="card " style="">
                            
                            <img class="card-img-top" src="<?php echo $row['image']; ?>"style="height: 280px;
    width: 200px;" alt="Card image cap">
                            <div class="card-body">

                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                        
                            </div>
                            <div class="card-body">

                                    <ul><li class="card-title">Rs. <?php echo $row['price']; ?>/-</li></ul>
                                        
                            </div>
                                  <div class="card-body">
                <a href="cart?remove=<?php echo $key; ?>" class="card-link">Remove</a>
                
            </div>
        </div>
        </div>
                        <?php
             }
         }
     }
 }
        ?>
            
                
            </br>
            </div>
        </div>
    </div><br>
                <div class="jumbotron">
                    <div class="container text-center">
                        <h3> Total : </h3> <h3> <?php echo $total?>/-</h3> 
                        <form action="" method="post" accept-charset="utf-8">
                            <button type="submit" name="save_order" class="btn btn-primary">Place Order</button>
                        </form>
                    </div>
                </div>
    <footer class="container-fluid text-center">
        <p>Food Shala</p>

        <!-- <form class="form-inline">Get deals: -->
        <!-- <input type="email" class="form-control" size="50" placeholder="Email Address"> -->
        <!-- <button type="button" class="btn btn-danger">Sign Up</button> -->
        <!-- </form> -->
    </footer>

</body>

</html>
