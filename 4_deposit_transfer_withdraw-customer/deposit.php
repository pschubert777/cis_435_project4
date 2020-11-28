<?php include '../header_footer_files/header.php'; ?>

<?php 
    require('../db_include/db_include.php');
    $currentUser = $_SESSION['userType'];
    $currentUserName = $_SESSION['userName'];
    $error_message ='';

    if ($currentUser == "customer")
    {
        $queryUser = "SELECT * FROM customer WHERE userName=:userName";
        $execStatement = $db->prepare($queryUser);
        $execStatement->bindValue(':userName', $currentUserName);
        $execStatement->execute();
        $fetchedUser = $execStatement->fetchAll();

        $queryAccounts = "SELECT * FROM customer_accounts WHERE customerID=:customerID";
        $execStatement1 = $db->prepare($queryAccounts);
        $execStatement1->bindValue(':customerID', $fetchedUser[0]['id']);
        $execStatement1->execute();
        $accounts = $execStatement1->fetchAll();

        if (isset($_POST['submit'])) {
            $entered_accountID = htmlspecialchars($_POST['accountID']);
            $entered_amount = htmlspecialchars($_POST['amount']);

            $queryAccount = "SELECT * FROM customer_accounts WHERE id=:entered_accountID";
            $execStatement2 = $db->prepare($queryAccount);
            $execStatement2->bindValue(':entered_accountID', $entered_accountID);
            $execStatement2->execute();
            $fetchedAccount = $execStatement2->fetchAll();

            $newBalance = $fetchedAccount[0]['Balance'] + $entered_amount;
            
            $queryUpdate = "UPDATE customer_accounts
                            SET Balance = :Balance
                            WHERE id = :accountID";
            $execStatement3 = $db->prepare($queryUpdate);
            $execStatement3->bindValue(':accountID', $fetchedAccount[0]['id']);
            $execStatement3->bindValue(':Balance', $entered_amount + $fetchedAccount[0]['Balance']);
            // echo $fetchedAccount[0]['accountType'];
            $execStatement3->execute();


        } 
    }
    

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>
            Deposit Money
        </title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            if ($currentUser == 'customer')
            {
        ?>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">

                <section>
                    <label for="accountID">Deposit Into:</label>
                    <select id="accountID" name="accountID">
                        <?php
                            foreach($accounts as $account)
                            {
                                echo '<option value="' . $account['id'] . '">' . $account['accountType'] . ' - ' . $account['id'] . '</option><br>';
                            }
                        ?>
                    </select>
                </section>

                <section>
                    <label for="amount">Deposit amount:</label>
                    <input type="text" id="amount" name="amount">
                    <br>
                </section>

                <input type="submit" name="submit" value="Deposit"><span> <?php echo $error_message?></span><br>
            </form>
        <?php
            } else {
            ?>
                <span>Only Customer is allowed to deposit money</span>
            <?php
            }
        ?>
    </body>
<html>

<?php include '../header_footer_files/footer.php'; ?>