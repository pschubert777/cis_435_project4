<?php
session_start();

/* if (!isset($_SESSION['username'])) {
    header('Location: /cis_435_project4/');
    exit();
} */


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
            if ($_SESSION['userType']=='customer'):
            ?>
                <li><a href="/cis_435_project4/deposit_page.php">Deposit Transfer Withdraw</a></li> 
                <li><a href="/cis_435_project4/6_create-checking-customer/create_checking-cd.php">Add New Account</a></li>
            <?php endif?>


            <?php 
            if ($_SESSION['userType']=='admin'):
            ?>
                <li><a href="/cis_435_project4/8_bank_metrics-admin/metrics.php">Records</a></li>
            <?php endif?>
                <li><a href="/cis_435_project4/9_10search_and_modify-admin-customer">Modify Account</a></li>
                <li><a href="/cis_435_project4/11_logout/logout.php"> Logout</a></li>
        </nav>
    </header>
