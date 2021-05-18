<?php
require_once "lib/config.php";
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
        // die($_GET['id']);
              $sql = "SELECT * FROM `menu` WHERE id =:id";
             if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":id", $_GET['id'], PDO::PARAM_INT);
                if($stmt->execute()){
                  $row = $stmt->fetch();

    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="jumbotron">
                    <div class="container text-center">
                        <h2><?php echo $row['name'];?> </h2>
                    </div>
                </div>
                <br />
                <div class>
                  <div class="card">
  <h5 class="card-header"> Rs. <?php echo $row['price']; ?>/-</5>
  <div class="card-body">
    <img class="card-img-top" src="<?php echo $row['image']; ?>"alt="Card image cap">
  </div>
  <br/>
  <div class="card-body">
    <p class="card-text"<?php echo $row['menu_desc']; ?></p>
    <?php if (!isset($_SESSION["type"] ) || $_SESSION["type"] !='rest'){
      ?>
      <a href="cart?id=<?php echo $row['id']; ?>" class="btn btn-primary">Add to Cart</a>
  <?php }
  ?>
  </div>
</div>
                </div>
            </br>
            </div>
        </div>
    </div><br>
<?php
      }
  }
?>
    <footer class="container-fluid text-center">
        <p>Food Shala</p>

        <!-- <form class="form-inline">Get deals: -->
        <!-- <input type="email" class="form-control" size="50" placeholder="Email Address"> -->
        <!-- <button type="button" class="btn btn-danger">Sign Up</button> -->
        <!-- </form> -->
    </footer>

</body>

</html>
