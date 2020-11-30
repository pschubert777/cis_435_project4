<?php
  require('../db_include/db_include.php');
  $id = $_GET['id'];
?>
<?php include '../header_footer_files/header.php'; ?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<title>
			Modify Account
		</title>
		<meta charset="UTF-8">
    <link rel="stylesheet" href="../main.css">
	</head>
	<body>
		<h1>Modify Account</h1>

<?php
    $queryProducts = "SELECT * FROM customer WHERE id=?";

    $execStatement = $db->prepare($queryProducts);
    $execStatement->execute([$id]);

    $cust = $execStatement->fetch();
    $execStatement->closeCursor();

    echo "<form action=\"update.php\" method=\"post\">
      <label for=\"fname\">First Name:</label><br>
      <input type=\"text\" id=\"fname\" name=\"fname\" value=\"" . $cust["firstName"] . "\"><br><br>
      <label for=\"lname\">Last Name:</label><br>
      <input type=\"text\" id=\"lname\" name=\"lname\" value=\"" . $cust["lastName"] . "\"><br><br>
      <label for=\"username\">Username:</label><br>
      <input type=\"text\" id=\"username\" name=\"username\" value=\"" . $cust["userName"] . "\"><br><br>
      <label for=\"password\">Password:</label><br>
      <input type=\"text\" id=\"password\" name=\"password\" value=\"" . $cust["password"] . "\"><br><br>
      <input type=\"hidden\" id=\"custID\" name=\"custID\" value=\"" . $cust["id"] . "\">
      <input type=\"submit\" value=\"Update Account\">
    </form>";

    if($_SESSION['userType'] == 'admin'){
      echo "<br><br>
            <h2><a href=\"index.php\"> Search Customers </a></h2>";
    }
?>


	</body>
</html>
