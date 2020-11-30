<?php
require('../db_include/db_include.php');

if(empty($_POST['fname'])){
  $fname = '';
}
else{
  $fname = $_POST['fname'];
}

$queryProducts = "SELECT * FROM customer WHERE firstName LIKE ?";

$execStatement = $db->prepare($queryProducts);
$execStatement->execute([$fname]);

$custList = $execStatement->fetchAll();
$execStatement->closeCursor();

include 'index.php';
echo "<h2>Results</h2>";
echo "<table class=\"productTable\">";
echo  "<tr>";
echo    "<th>Name</th>
        <th></th>
      </tr>";
    if(empty($custList)){
      echo "Please search a first name";
    }
    else{
      foreach($custList as $cust) {
        echo "<tr>";
        echo "<td>" . $cust['firstName'] . " " . $cust['lastName'] . "</td>";
        echo "<td><button><a href=\"edit_customers.php?id=". $cust['id'] ."\"> Select </a></button></td>";
        echo "</tr>";
      }
    }
echo "</table>";

?>
<?php include '../header_footer_files/footer.php'; ?>
