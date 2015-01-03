<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $descError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $desc = $_POST['desc'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Title';
            $valid = false;
        }
         
        if (empty($desc)) {
            $descError = 'Please enter Valid descriptin';
            $valid = false;
        } 
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Discount (D_title,D_body) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$desc));
            Database::disconnect();
            header("Location: show_discounts.php");
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
                        <h3>Create a New Offer</h3>
                    </div>
             
                    <form class="form-horizontal" action="create_discounts.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Offer Title</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder=" Offer Title" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descError)?'error':'';?>">
                        <label class="control-label"> Offer Description</label>
                        <div class="controls">
                            <input name="desc" type="text" placeholder="Offer Description" value="<?php echo !empty($desc)?$desc:'';?>">
                            <?php if (!empty($descError)): ?>
                                <span class="help-inline"><?php echo $descError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href=".php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
