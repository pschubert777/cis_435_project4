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
            $queryCurrentCust = 'SELECT userName, password, id FROM customer WHERE userName=:uName AND password=:passwrd';
            
            $prep_stmt = $db->prepare($queryCurrentCust);
            $prep_stmt->execute(['uName' => $currentUserName, 'passwrd' => $currentPassword]);
            $row = $prep_stmt->fetchAll();           
            $row_count = $prep_stmt->rowCount();
            
            if($row_count == 1){ 
                // there was a result of that username and password combination
                foreach($row as $newCustAccount){
                    $custID = $newCustAccount['id'];
                    // the account type is already in $accountType
                }
                // insert into customer_accounts table now
                $newAccountQuery = 'INSERT INTO customer_accounts (customerID, accountType) VALUES (:custID, :accountType)';

                $prep_stmt = $db->prepare($newAccountQuery);
                $prep_stmt->execute(['custID' => $custID, 'accountType' => $accountType]);

                // display success or error message
                if($prep_stmt->rowCount() == 1){
                    echo '<main>';
                    echo '<h1>Create New Banking Account</h1>';
                    echo '<p>Account Type {'.$accountType.'} was created succesfully</p>';
                    echo '</main>';
                    exit();
                }
                else{
                    echo '<main>';
                    echo '<h1>Create New Banking Account</h1>';
                    echo 'The account was <em>not</em> created.<br><br>';
                    echo '</main>';
                    exit();
                }
            }
            else{
                $error = "There was no customer account with that UserName and Password";
            }
        }
        
     }

?>

<main>
<h2>Create New Banking Account</h2>
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

<?php 
    include('../header_footer_files/footer.php');
?>