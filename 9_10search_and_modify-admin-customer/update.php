<?php
require('../db_include/db_include.php');

if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['username']) || empty($_POST['password'])){
  echo "One or more fields where not entered. Please return to the form.";
}
else{
  $id = $_POST['custID'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  session_start();
  $_SESSION['userName']=$username;

  $queryProducts = "UPDATE customer SET firstName=?, lastName=?, userName=?, password=? WHERE id=?";

  $execStatement = $db->prepare($queryProducts);
  $execStatement->execute([$fname, $lname, $username, $password, $id]);
  $execStatement->closeCursor();
  echo '<script type="text/javascript"> ';
  echo '  if (alert("Account has been updated")) {';
  echo '    window.location.href = "index.php";';
  echo '  }
          else{
            window.location.href = "index.php";
          }';
  echo '</script>';
  //header("Location: index.php");
}

?>
