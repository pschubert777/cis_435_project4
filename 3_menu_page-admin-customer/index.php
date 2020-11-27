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

if ($entered_usertype=='customer'):

    $balance_query=  'SELECT accountType, Balance FROM customer_accounts WHERE customerID =:customerID';
    $execute_balance_query = $db->prepare($balance_query);
    $execute_balance_query->execute(['customerID' =>$id]);
    $balance_result = $execute_balance_query->fetchAll();

?>
<table>
<tr> 
<th>Account Type</th>
<th>Balance</th>
</tr>

<?php foreach ($balance_query as $account_balance ):  ?>

            <tr>
            <td> <?php echo $account_balance['accountType'] ?> </td>
            <td> <?php echo $account_balance['Balance']  ?></td>

            </tr>

<?php endforeach; ?>




</table>


<?php endif; ?>
</main>




<?php 

include('../header_footer_files/footer.php')

?>