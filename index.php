<?php

$error_message ='';
session_start();
if (isset($_SESSION['userType'])) {
    header('Location: /cis_435_project4/3_menu_page-admin-customer');
    exit();
}
if (isset($_POST['submit'])) {
    

//query the database to check if the user exists


$user_type= htmlspecialchars($_POST['user_type']);
$entered_username = htmlspecialchars($_POST['username']);
$entered_password=htmlspecialchars($_POST['password']);

if ($entered_username==''|| $entered_password=='' || strlen($entered_username)>20 || strlen($entered_password)>100 ) {
    $error_message='Please enter a valid input!';
}

else{
 // check if the user is valid 
 include('db_include/db_include.php');
 $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

 $query= ($user_type=='admin')? 'SELECT *FROM admin WHERE userName =:userName AND password=:password':'SELECT *FROM customer WHERE userName =:userName AND password=:password';
 $execute_query= $db->prepare($query);
 $execute_query->execute(['userName'=>$entered_username, 'password'=>$entered_password]);
 $row_count= $execute_query->rowCount();
 


 if ($row_count>0) {
     $_SESSION['userType']=$user_type;
     $_SESSION['userName']=$entered_username;

     header('Location: /cis_435_project4/3_menu_page-admin-customer');
     exit();
 }
 else{

$error_message='Invalid credentials!';
 }
 $records = $execute_query->fetch();




}

}

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
    
     <h1>Welcome to the Banking System</h1>
     
    </header>
    <main>
        
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
       
        <select name="user_type" id="user_type">
            <option value="admin"> Administrator</option>
            <option value="customer"> Customer</option>
        </select> 
        <section>
         <label for="username">Username:</label><input type="text" name="username" id="username"><br>

        </section>
        
       <section>
        <label for="password">Password: </label><input type="password" name="password" id="password"><br>
       </section>
       
       <section>
       <input type="submit"  name="submit" value="Login!"> <span> <?php echo $error_message?></span>
       </section>
       </form>
       
       

    
    
    </main>

    <footer>
    <p>

        &copy Nisarg Patel, Peter Schubert, Geoffrey Lynch, Nathan Carey 2020
    </p>

    
    </footer>




</body>
</html>



