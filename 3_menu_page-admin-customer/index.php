<?php 
    include('../header_footer_files/header.php');

    $entered_username = $_SESSION['userName'];
    $entered_usertype= $_SESSION['userType'];

    include('../db_include/db_include.php');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    $query= ($entered_usertype=='admin')? 'SELECT id, firstName, lastName FROM admin WHERE userName =:userName':'SELECT firstName, lastName FROM customer WHERE userName =:userName';
    $execute_query= $db->prepare($query);
    $execute_query->execute(['userName'=>$entered_username]);
    $result = $execute_query->fetch();

    $firstName = $result['firstName'];
    $lastName=$result['lastName'];
    $id = $result['id'];


    


 
?>

<main>

<h2>Welcome <?php echo $firstName.' '.$lastName;  ?> </h2>


<?php 


    if ($entered_usertype=='customer') {

        $balance_query=  'SELECT accountType, Balance FROM customer_accounts WHERE customerID =:customerID';
        $execute_balance_query = $db->prepare($balance_query);



    }



?>

</main>




<?php 

include('../header_footer_files/footer.php')

?>