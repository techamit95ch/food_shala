<?php
require_once "lib/config.php";
$logged_in =0;

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    $logged_in =1;


    require_once 'lib/reduse.php';
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        extract ($_GET);
        $edit_id='';
        $delete_id='';
        if (isset($edit)){
            $edit_id= $edit;
        }
        if (isset($delete)){
            $sql = "DELETE FROM `menu` WHERE id= :id";
            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":id", $delete, PDO::PARAM_INT);
                if($stmt->execute()){
                    header("location: menu");
                }
            }
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        extract ($_POST);

        if(isset($save)){
            $valid_exts = array('jpeg', 'jpg', 'JPG', 'JPEG');


            if(!empty($_FILES['image']['name'])){

                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

                $path     = 'image/'.rand(1, 9999).'_'.time().'.'.$ext;     // File store in image folder
                $img_name = compress_image($_FILES["image"]["tmp_name"], $path, 50); // Compress File in KB, (Here
// 10 is a percentege size of total size orginal file)
                $img_path =  $img_name;
        // $img_path1 = $img_path[1];
                $sql = "UPDATE `menu` SET name=:name,type=:type, menu_desc=:menu_desc,image=:image,price=:price WHERE id=:id";
                if($stmt = $pdo->prepare($sql)){

                    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                    $stmt->bindParam(":type", $type, PDO::PARAM_STR);
                    $stmt->bindParam(":menu_desc", $menu_desc, PDO::PARAM_STR);
                    $stmt->bindParam(":image", $img_path, PDO::PARAM_STR);
                    $stmt->bindParam(":price", $price, PDO::PARAM_STR);
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                    if($stmt->execute()){
                        header("location: menu");
                    }
                }

            }else{
                $sql = "UPDATE `menu` SET `name`=:name,`type`=:type, `menu_desc`=:menu_desc,`price`=:price WHERE `id`= :id";
        // die($price);
                if($stmt = $pdo->prepare($sql)){

                    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                    $stmt->bindParam(":type", $type, PDO::PARAM_STR);
                    $stmt->bindParam(":menu_desc", $menu_desc, PDO::PARAM_STR);  
                    $stmt->bindParam(":price", $price, PDO::PARAM_STR);                  
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                    if($stmt->execute()){
                        header("location: menu");
                    }
                }
            }
      
        }
    }

    
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
                        <h2>All Foods</h2>
                    </div>
                </div>
                <br />
                
        <?php
             $sql = "SELECT * FROM menu WHERE res_id = :res_id";
             if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":res_id", $_SESSION['id'], PDO::PARAM_INT);
                if($stmt->execute()){
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) {
                        ?>
                        <div class="col-sm-4">
                        <div class="card " style="">
                            <?php if ($edit_id == md5($row['id'])){
                                    ?>
                                    
                                        <form method= "post"  enctype="multipart/form-data">
  <div class="form-group row">
    <label for="menu" class="col-sm-2 col-form-label">Menu Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name= "name" id="menu" placeholder="Menu" required>
      <input type="hidden" name= "id" value="<?php echo $row['id']; ?>" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="menu" class="col-sm-2 col-form-label">Menu Price</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name= "price" id="price" placeholder="Price" required>
      
    </div>
  </div>

  <div class="form-group row" id ="pref">
      <label class="col-sm-2 col-form-label">Food Preffernce</label>
      <div class="col-sm-10">
      <select name="type"
          class="form-control" required>
      <option value="" selected disabled> Select Preffernce </option>
      <option value="veg"> Veg </option>
      <option value="nonveg"> Non-Veg</option>
      </select>

</div>
  </div>
  <div class="form-group row">
    <label for="desc" class="col-sm-2 col-form-label">Menu Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" name= "menu_desc" id="desc" placeholder="Menu Description" required></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Menu Image</label>
    <div class="col-sm-10">
        <img class="card-img-top" src="<?php echo $row['image']; ?>" style = "height: 120px" alt="Card image cap">
      <input type="file" class="form-control" name= "image" id="image" placeholder="Menu Image" >
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name ="save" class="btn btn-primary">Edit Menu</button>
    </div>
  </div>
</form>
                                   
                                    <?php
                                }else{
                                        ?>
                            <img class="card-img-top" src="<?php echo $row['image']; ?>"style="height: 280px;
    width: 200px;" alt="Card image cap">
                            <div class="card-body">

                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                        
                            </div>
                            <div class="card-body">

                                    <ul><li class="card-title">Rs. <?php echo $row['price']; ?>/-</li></ul>
                                        
                            </div>
                                <?php
                                }
                                ?>
         <?php if ($edit_id != md5($row['id'])){ ?>   <div class="card-body">
                <a href="menu?edit=<?php echo md5($row['id'])?>" class="card-link">Edit</a>
                <a href="menu?delete=<?php echo $row['id']?>" class="card-link">Delete</a>
            </div><?php } ?>
        </div>
        </div>
                        <?php
                    }
                }
             }
        ?>
            
                
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
