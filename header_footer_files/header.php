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
            <li><a href="/cis_435_project4/menu.php"> Menu</a></li>

            <li><a href="/cis_435_project4/deposit_page.php">Deposit Transfer Withdraw</a></li>
            <li><a href="/cis_435_project4/creation_account_page.php">Add New Account</a></li>
            <li><a href="/cis_435_project4/historical_data_page.php">Records</a></li>
            <li><a href="/cis_435_project4/9_10search_and_modify-admin-customer">Modify Account</a></li>
            <li><a href="/cis_435_project4/11_logout/logout.php"> Logout</a></li>
        </nav>
    </header>
