<?php session_start(); ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Category Items</h3>
            </div>
            <div class="row">
            <p> <a href="create_items.php" class="btn btn-success">Create</a> </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  require 'database.php';
                    $id = null;
                    if ( !empty($_GET['id'])) {
                        $id = $_REQUEST['id'];
                        $_SESSION["a1"] = $id;
                    }
                     
                    if ( null==$id ) {
                        header("Location: index.php");
                    } else {
                   $pdo = Database::connect();
                   $sql = "SELECT * FROM Items where I_C_id = '" . $id . "'";
                   $result = $pdo->query($sql);
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['I_id'] . '</td>';
                            echo '<td>'. $row['I_name'] . '</td>';
                            echo '<td>'. $row['I_desc'] . '</td>';
                            echo '<td>'. $row['I_price'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn btn-success" href="update_items.php?id='.$row['I_id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete_items.php?id='.$row['I_id'].'">Delete</a>';
                                echo '</td>';
                            echo '</tr>';
                   }
               }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
