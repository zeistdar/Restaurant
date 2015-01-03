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
                <h3>Discount Offers</h3>
            </div>
            <div class="row">
            <p> <a href="create_discounts.php" class="btn btn-success">Create</a> </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM Discount';
                   $result = $pdo->query($sql);
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['D_id'] . '</td>';
                            echo '<td>'. $row['D_title'] . '</td>';
                            echo '<td>'. $row['D_body'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn" href="show_discount.php?id=' . $row['D_id'] . '">Show items</a>';
                            echo ' ';
                                echo '<a class="btn btn-success" href="edit_discounts.php?id='.$row['D_id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete_discounts.php?id='.$row['D_id'].'">Delete</a>';
                                echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
