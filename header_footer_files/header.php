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
            <li><a href="/cis_435_project4/menu.php"> Menu</a></li>
            
            <li><a href="/cis_435_project4/4_deposit_transfer_withdraw-customer/deposit.php">Deposit</a></li>
            <li><a href="/cis_435_project4/4_deposit_transfer_withdraw-customer/withdraw.php">Withdraw</a></li>
            <li><a href="/cis_435_project4/4_deposit_transfer_withdraw-customer/transfer.php">Transfer</a></li>
            <li><a href="/cis_435_project4/creation_account_page.php">Add Checking</a></li>
            <li><a href="/cis_435_project4/historical_data_page.php">Records</a></li>
            <li><a href="/cis_435_project4/modify_account_page.php">My Info</a></li>
            <li><a href="/cis_435_project4/11_logout/logout.php"> Logout</a></li>
        </nav>
    </header>
