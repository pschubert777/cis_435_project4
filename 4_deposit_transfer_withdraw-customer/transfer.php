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

        $accountsRowCount = $execStatement1->rowCount();
        if ($accountsRowCount == 0)
        {
            $error_message = 'Error: You have no registered account';
        } else {
            if (isset($_POST['submit'])) {
                $entered_fromAccountID = htmlspecialchars($_POST['fromAccountID']);
                $entered_toAccountID = htmlspecialchars($_POST['toAccountID']);
                $entered_amount = htmlspecialchars($_POST['amount']);

                $queryFromAccount = "SELECT * FROM customer_accounts WHERE id=:entered_fromAccountID";
                $execStatement2 = $db->prepare($queryFromAccount);
                $execStatement2->bindValue(':entered_fromAccountID', $entered_fromAccountID);
                $execStatement2->execute();
                $fetchedFromAccount = $execStatement2->fetchAll();

                $queryToAccount = "SELECT * FROM customer_accounts WHERE id=:entered_toAccountID";
                $execStatement4 = $db->prepare($queryToAccount);
                $execStatement4->bindValue(':entered_toAccountID', $entered_toAccountID);
                $execStatement4->execute();
                $fetchedToAccount = $execStatement4->fetchAll();

                if ($entered_amount == '')
                {
                    $error_message = 'Error: Transfer amount is empty';
                } else if ($fetchedFromAccount[0]['Balance'] - $entered_amount < 0) {
                    $error_message = 'Error: Transfer amount excedes current balance in ' . $fetchedFromAccount[0]['accountType'] . ' - ' . $fetchedFromAccount[0]['id'] . '';
                } else if ($fetchedFromAccount[0]['id'] == $fetchedToAccount[0]['id']) {
                    $error_message = 'Error: Cannot tranfer to the same account';
                } else {
                    $queryFromUpdate = "UPDATE customer_accounts
                                                SET Balance = :Balance
                                                WHERE id = :accountID";
                    $execStatement5 = $db->prepare($queryFromUpdate);
                    $execStatement5->bindValue(':accountID', $fetchedFromAccount[0]['id']);
                    $execStatement5->bindValue(':Balance', $fetchedFromAccount[0]['Balance'] - $entered_amount);
                    $execStatement5->execute();


                    $queryToUpdate = "UPDATE customer_accounts
                                                SET Balance = :Balance
                                                WHERE id = :accountID";
                    $execStatement3 = $db->prepare($queryToUpdate);
                    $execStatement3->bindValue(':accountID', $fetchedToAccount[0]['id']);
                    $execStatement3->bindValue(':Balance', $fetchedToAccount[0]['Balance'] + $entered_amount);
                    $execStatement3->execute();
                } 
            }
        }
        

        
    } else {
        $error_message = 'Only Customer is allowed to transfer money';
    }
    

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>
            Transfer Money
        </title>
        <link rel="stylesheet" type="text/css" href="/cis_435_project4/styles/main.css">
        <meta charset="UTF-8">
    </head>
    <main>
        <?php
            if ($currentUser == 'customer')
            {
        ?>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">

                <section>
                    <label for="fromAccountID">Transfer From:</label>
                    <select id="fromAccountID" name="fromAccountID">
                        <?php
                            foreach($accounts as $account)
                            {
                                echo '<option value="' . $account['id'] . '">' . $account['accountType'] . ' - ' . $account['id'] . '</option><br>';
                            }
                        ?>
                    </select>
                </section>

                <section>
                    <label for="toAccountID">Transfer To:</label>
                    <select id="toAccountID" name="toAccountID">
                        <?php
                            foreach($accounts as $account)
                            {
                                echo '<option value="' . $account['id'] . '">' . $account['accountType'] . ' - ' . $account['id'] . '</option><br>';
                            }
                        ?>
                    </select>
                </section>

                <section>
                    <label for="amount">Transfer amount:</label>
                    <input type="text" id="amount" name="amount">
                    <br>
                </section>

                <section>
                    <input type="submit" name="submit" value="Transfer"><span> <?php echo $error_message?></span><br>
                </section>
                
            </form>
        <?php
            } else {
            ?>
                <span><?php echo $error_message; ?></span>
            <?php
            } 
        ?>
    </main>
<html>

<?php include '../header_footer_files/footer.php'; ?>