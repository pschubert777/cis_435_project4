<?php 
    include('../header_footer_files/header.php');
    include('../db_include/db_include.php');

    $error = "";

    $currentCustomer = $_SESSION['userName'];
    $custID="";
    $get_custID = 'SELECT id FROM customer WHERE userName = :userName';

    $prep_stmt = $db->prepare($get_custID);
    $prep_stmt->execute(['userName' => $currentCustomer]);
    $row = $prep_stmt->fetch();
    $row_count = $prep_stmt->fetchColumn();
   

    // get customer ID if only one record is returned
   $custID=$row['id'];


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
    $query = 'SELECT * FROM historicaldata WHERE customerID = :customerID';

    $prep_customer = $db->prepare($query);
    $prep_customer->execute(['customerID' => $custID]);
    $row2=$prep_customer->fetchAll(PDO::FETCH_OBJ);
    
    foreach($row2 as $row){
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