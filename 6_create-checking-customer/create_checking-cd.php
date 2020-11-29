<?php 
    include('../header_footer_files/header.php');
    
    $error = "";
     // if submit button pressed
     if(isset($_POST['submit'])){
        if(empty($_POST['currentUserName']) || empty($_POST['currentPassword'])){
            $error = "ERROR. Please check that a username and password were entered.";
        }
        else{
            include('../db_include/db_include.php');

            // get username
            $currentUserName = htmlentities($_POST['currentUserName']);
            // get password
            $currentPassword = htmlentities($_POST['currentPassword']);
            // check that radio button selected not empty
            if (empty($_POST["accountType"])) {
                $error = "Account type required";
            } 
            else {
                // get selected account type from radio button
                $accountType = $_POST["accountType"];
            }
            
            // query and add record
            $queryCurrentCust = 'SELECT userName, password FROM customer WHERE userName=:uName, password=:passwrd';
            echo $currentUserName; echo $currentPassword;
            $prep_stmt = $db->prepare($queryCurrentCust);
            $prep_stmt->execute(['uName' => $currentUserName, 'passwrd' => $currentPassword]);
            $row = $prep_stmt->fetchAll();           
            $row_count = $prep_stmt->rowCount();
            print_r($row);
            if($row_count == 1){ 
                // there was a result of that username and password combination
                echo "im inside rowcount 1";
            }
            else{
                $error = "There was no customer account with that User Name and Password";
            }


            
        }
        
     }

?>

<main>
<h2>Select your desired type of account</h2>
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
    UserName: 
    <input type="text" name="currentUserName" id="currentUserName" placeholder="UserName"><br>
    Password: 
    <input type="text" name="currentPassword" id="currentPassword" placeholder="Password"><br>
    Account:
    <input type="radio" name="accountType"
    <?php if (isset($accountSelection) && $accountSelection == "Checking") echo "checked";?> value="Checking">Checking
    <input type="radio" name="accountType"
    <?php if (isset($accountSelection) && $accountSelection == "CD") echo "checked";?> value="CD">CD
    <br>
    <input name="submit" type="submit" value="Create Account"></input> <br><br>
</form>
<p class="error"><?php echo $error; ?></p>

</main>