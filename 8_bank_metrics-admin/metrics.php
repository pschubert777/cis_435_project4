<?php 
// Metrics:
// 1.) Total amount of money in bank (sum of all accounts balance)
// 2.) Total amount in individual checkings
// 3.) Total amount in individual CD
// 4.) Total amount in individual savings

    include('../header_footer_files/header.php');
    include('../db_include/db_include.php');

    $error = "";

    // 1.) Total amount of money in bank (sum of all accounts balance)
    $sumQuery = 'SELECT SUM(Balance) AS bal_sum FROM customer_accounts';
    $prep_stmt = $db->prepare($sumQuery);
    $prep_stmt->execute();
    $row = $prep_stmt->fetch(PDO::FETCH_ASSOC);
    $totalSum = $row['bal_sum'];
    // if no accounts
    if(empty($row['bal_sum'])){
        $totalSum = 0;
    }
    else{
        $totalSum = $row['bal_sum'];
    }


    // 2.) Total amount in individual checkings
    $checkingParam = "Checkings";
    $sumCheckingsQuery = 'SELECT SUM(Balance) AS bal_check_sum FROM customer_accounts WHERE accountType = :accountType';
    $prep_stmt_checking = $db->prepare($sumCheckingsQuery);
    $prep_stmt_checking->execute(['accountType' => $checkingParam]);
    $row = $prep_stmt_checking->fetch(PDO::FETCH_ASSOC);
    $totalCheckings = $row['bal_check_sum'];
    // if no accounts of this type
    if(empty($row['bal_check_sum'])){
        $totalCheckings = 0;
    }
    else{
        $totalCheckings = $row['bal_check_sum'];
    }


    // 3.) Total amount in individual CD
    $cdParam = "CD";
    $sumCDQuery = 'SELECT SUM(Balance) AS bal_cd_sum FROM customer_accounts WHERE accountType = :accountType';
    $prep_stmt_cd = $db->prepare($sumCDQuery);
    $prep_stmt_cd->execute(['accountType' => $cdParam]);
    $row = $prep_stmt_cd->fetch(PDO::FETCH_ASSOC);
    // if no accounts of this type
    if(empty($row['bal_cd_sum'])){
        $totalCD = 0;
    }
    else{
        $totalCD = $row['bal_cd_sum'];
    }

    // 4.) Total amount in individual savings
    $savingsParam = "Savings";
    $sumCheckingsQuery = 'SELECT SUM(Balance) AS bal_sav_sum FROM customer_accounts WHERE accountType = :accountType';
    $prep_stmt_savings = $db->prepare($sumCheckingsQuery);
    $prep_stmt_savings->execute(['accountType' => $savingsParam]);
    $row = $prep_stmt_savings->fetch(PDO::FETCH_ASSOC);
    $totalSavings = $row['bal_sav_sum'];
    // if no accounts of this type
    if(empty($row['bal_sav_sum'])){
        $totalSavings = 0;
    }
    else{
        $totalSavings = $row['bal_sav_sum'];
    }


?>
<main>
<h2>Total Balance in Bank:<?php echo ' '.$totalSum?></h2>
<h2>Total Balance in Checkings Accounts:<?php echo ' '.$totalCheckings?></h2>
<h2>Total Balance in CD Accounts:<?php echo ' '.$totalCD?></h2>
<h2>Total Balance in Savings Accounts:<?php echo ' '.$totalSavings?></h2>
<p class="error"><?php echo $error; ?></p>
</main>

<?php include('../header_footer_files/footer.php'); ?>