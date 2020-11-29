<?php include '../header_footer_files/header.php'; ?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<title>
			Manage Customers
		</title>
		<meta charset="UTF-8">
    <link rel="stylesheet" href="../main.css">
	</head>
	<body>
    <?php
        if($_SESSION['userType'] == 'admin'){
          echo "<h1>Customer Search</h1>";
          echo "<form action=\"search_customers.php\" method=\"post\">
            <label for=\"fname\">First Name:</label><br>
            <input type=\"text\" id=\"fname\" name=\"fname\" value=\"\"><br><br>
            <input type=\"submit\" value=\"Search\">
          </form>";
        }
        else{
            require('../db_include/db_include.php');
            $queryProducts ='SELECT * FROM customer WHERE userName=?';

            $execStatement = $db->prepare($queryProducts);
            $execStatement->execute([$_SESSION['userName']]);

            $cust = $execStatement->fetch();
            $execStatement->closeCursor();
            header("Location: edit_customers.php?id=" . $cust['id']);
        }
     ?>
	</body>
</html>
