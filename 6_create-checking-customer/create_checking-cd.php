<?php 
    include('../header_footer_files/header.php');
    include('../db_include/db_include.php');



     // if submit button pressed
     if(isset($_POST['submit'])){


        // check that $username not empty

        // check that $passowrd not empty

        // check that radio button selected not empty


        // query and add record

     }



?>

<main>
<h2>Select your desired type of account</h2>
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
    UserName: <input type="text" name="userName" value="<?php echo $userName;?>"><br>
    Password: <input type="text" name="password" value="<?php echo $password;?>"><br>
    Account:
    <input type="radio" name="account"
    <?php if (isset($accountSelection) && $accountSelection == "Checking") echo "checked":?> value="Checking">Checking
    <input type="radio" name="account"
    <?php if (isset($accountSelection) && $accountSelection == "CD") echo "checked":?> value="CheCDcking">CD
    <br>
    <input name="submit" type="submit" value="Register Product"></input> <br><br>
</form>

</main>