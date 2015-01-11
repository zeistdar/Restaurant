<?php
     
    require 'database.php';
    require 'decipher_key.php';
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $descError = null;
        $validation = 1;
        $code = date('mdYhis');        // keep track post values
        $name = $_POST['name'];
        $desc = $_POST['desc'];
         
        // validate input
        $valid = true;
        if (empty($name)|| filter_var($name, FILTER_VALIDATE_INT) == false) {
            $nameError = 'Please enter valid Type';
            $valid = false;
        }
         
        if (empty($desc)) {
            $descError = 'Please enter Message';
            $valid = false;
        } 
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Offer (O_Type,O_Message,O_code,O_validation) values(?, ?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$desc,$code,$validation));
            Database::disconnect();
            header("Location: generate_key.php");
        }
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
                        <h3>Create a New Coupon</h3>
                    </div>
             
                    <form class="form-horizontal" action="generate_coupon.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Coupon Type</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Coupon Type" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descError)?'error':'';?>">
                        <label class="control-label"> Coupon Message</label>
                        <div class="controls">
                            <input name="desc" type="text" placeholder="Coupon Message" value="<?php echo !empty($desc)?$desc:'';?>">
                            <?php if (!empty($descError)): ?>
                                <span class="help-inline"><?php echo $descError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="generate_key.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
