<?php session_start(); 
    require 'database.php';
 	    $ido = null;
         if ( !empty($_GET['id'])) {
              $ido = $_REQUEST['id'];
              echo $ido;
         }
         
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $descError = null;
        $priceError = null;
        // keep track post values
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $id = $_POST['id'];

        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($desc)) {
            $descError = 'Please enter Valid descriptin';
            $valid = false;
        }
        if (empty($price) || filter_var($price, FILTER_VALIDATE_INT) == false) {
            $priceError = 'Please enter a valid price';
            $valid = false;
        }  
        // insert data
        else if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Items SET I_name = ? , I_desc = ? ,I_price = ? WHERE I_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$desc,$price,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    }
        else {
        echo $ido;
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Items where I_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ido));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['I_name'];
        $desc = $data['I_desc'];
        $price = $data['I_price'];
        Database::disconnect();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update Items</h3>
                    </div>
             
                    <form class="form-horizontal" action="update_items.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $ido;?>"/>
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Item Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="desc" type="text" placeholder="Item Description" value="<?php echo !empty($desc)?$desc:'';?>">
                            <?php if (!empty($descError)): ?>
                                <span class="help-inline"><?php echo $descError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input name="price" type="text" placeholder="Item Price" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>

