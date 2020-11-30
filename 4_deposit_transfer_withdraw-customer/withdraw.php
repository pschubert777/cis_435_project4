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
                $entered_accountID = htmlspecialchars($_POST['accountID']);
                $entered_amount = htmlspecialchars($_POST['amount']);

                $queryAccount = "SELECT * FROM customer_accounts WHERE id=:entered_accountID";
                $execStatement2 = $db->prepare($queryAccount);
                $execStatement2->bindValue(':entered_accountID', $entered_accountID);
                $execStatement2->execute();
                $fetchedAccount = $execStatement2->fetchAll();

                
                
                if ($entered_amount == '') {
                    $error_message = 'Error: Withdraw amount is empty';
                }
                else if ($entered_amount < 0)
                {
                    $error_message = 'Error: Withdraw amount is negative';
                }
                else if ($fetchedAccount[0]['Balance'] - $entered_amount < 0) {
                    $error_message = 'Error: withdrawal amount excedes current balance';
                }
                else {
                    $newBalance = $fetchedAccount[0]['Balance'] + $entered_amount;
                    $queryUpdate = "UPDATE customer_accounts
                                                SET Balance = :Balance
                                                WHERE id = :accountID";
                    $execStatement3 = $db->prepare($queryUpdate);
                    $execStatement3->bindValue(':accountID', $fetchedAccount[0]['id']);
                    $execStatement3->bindValue(':Balance', $fetchedAccount[0]['Balance'] - $entered_amount);
                    $execStatement3->execute();
                    header('Location: /cis_435_project4/3_menu_page-admin-customer');
                } 
            


            } 
        }

        
    } else {
        $error_message = 'Only Customer is allowed to withdraw money';
    }
    

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>
            Withdraw Money
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
                    <label for="accountID">Withdraw From:</label>
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
                    <label for="amount">Withdraw amount:</label>
                    <input type="text" id="amount" name="amount">
                    <br>
                </section>

                <section>
                    <input type="submit" name="submit" value="Withdraw"><span> <?php echo $error_message?></span><br>
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