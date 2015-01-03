<?php
     
    require 'database.php';
 	    $ido = null;
         if ( !empty($_GET['id'])) {
              $ido = $_REQUEST['id'];
         }
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $descError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $desc = $_POST['desc'];
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

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Categories SET C_name = ?, C_description = ? WHERE C_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$desc,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    }
        else {
        echo $ido;
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Categories where C_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ido));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['C_name'];
        $desc = $data['C_description'];
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
                        <h3>Update Category</h3>
                    </div>
             
                    <form class="form-horizontal" action="update_categories.php" method="post">
                         <input type="hidden" name="id" value="<?php echo $ido;?>"/>
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder=" Category Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="desc" type="text" placeholder="Category Description" value="<?php echo !empty($desc)?$desc:'';?>">
                            <?php if (!empty($descError)): ?>
                                <span class="help-inline"><?php echo $descError;?></span>
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

