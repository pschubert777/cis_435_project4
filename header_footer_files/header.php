<?php
session_start();

//  if (!isset($_SESSION['username'])) {
//     header('Location: /cis_435_project4/');
//     exit();
// } 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banking System</title>
    <link rel="stylesheet" type="text/css" href="/cis_435_project4/styles/main.css">
</head>
<body>
    <header>
        <nav>
                <li><a href="/cis_435_project4/3_menu_page-admin-customer"> Menu</a></li>

            <?php 
            $userType=$_SESSION['userType'];
            $variable='';
            if ($userType=='customer'):
                $variable='Modify Account';
            ?>
                <li><a href="/cis_435_project4/4_deposit_transfer_withdraw-customer/deposit.php">Deposit</a></li>
                <li><a href="/cis_435_project4/4_deposit_transfer_withdraw-customer/withdraw.php">Withdraw</a></li>
                <li><a href="/cis_435_project4/4_deposit_transfer_withdraw-customer/transfer.php">Transfer</a></li>
                <li><a href="/cis_435_project4/6_create-checking-customer/create_checking-cd.php">Add New Account</a></li>
            
             <?php 
            else:
                $variable = 'Search Customer';
            ?>
                <li><a href="/cis_435_project4/8_bank_metrics-admin/metrics.php">Bank Metrics</a></li>
                <li><a href="/cis_435_project4/7_create_new_users-admin">Create New Users</a></li>
             <?php 
            endif;
            ?>
                <li><a href="/cis_435_project4/9_10search_and_modify-admin-customer"><?php echo $variable ?> </a></li>
                <li><a href="/cis_435_project4/11_logout/logout.php"> Logout</a></li>
        </nav>
    </header>
