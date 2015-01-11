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
            <p> <a href="generate_coupon.php" class="btn btn-success">Create</a> </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Type</th>
                      <th>Code</th>
                      <th>Message</th>
                      <th>Validation</th>

                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM Offer';
                   $result = $pdo->query($sql);
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['O_id'] . '</td>';
                            echo '<td>'. $row['O_Type'] . '</td>';
                            echo '<td>'. $row['O_Code'] . '</td>';
                            echo '<td>'. $row['O_Message'] . '</td>';
                            echo '<td>'. $row['O_Validation'] . '</td>';

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
