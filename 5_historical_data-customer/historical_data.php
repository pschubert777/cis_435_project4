<?php 
    include('../header_footer_files/header.php');
    include('../db_include/db_include.php');

    $error = "";

    $currentCustomer = $_SESSION['userName'];

    $get_custID = $db->query('SELECT customerID FROM customer WHERE userName = :userName');

    $prep_stmt = $db->prepare($get_custID);
    $prep_stmt->execute(['userName' => $currentCustomer]);
    $row = $prep_stmt->fetchAll();
    $row_count = $prep_stmt->rowCount();

    // get customer ID if only one record is returned
    if($row_count ==1 ){
        foreach($row as $curCustomer){
            // get customers id
            $custID = $curCustomer['customerID'];
        }
    }
    else{
        $error = "Error retrieving customer id from the user name.";
    }


?>

<main>
    <h2>Historical Customer Data</h2>
    <table>
    <tr>
        <th>Record ID</th>
        <th>Customer ID</th>
        <th>Activity</th>
        <th>Time</th> 
    </tr>
    <?php
    // set query
    $query = $db->query('SELECT * FROM historicaldata WHERE customerID = :customerID');

    $prep_customer = $db->prepare($query);
    $prep_customer->execute(['customerID' => $custID]);
    

    while($row = $prep_customer->fetch(PDO::FETCH_OBJ)){
        echo '<tr>';
        echo '<td>' . $row->id . '</td>';
        echo '<td>' . $row->customerID . '</td>';
        echo '<td>' . $row->activityType . '</td>';
        echo '<td>' . $row->timeStamp . '</td>';
        echo '<tr>';
    }

    ?>
    </table>
    <p class="error"><?php echo $error; ?></p>
</main>
<?php 
    include('../header_footer_files/footer.php');
?>