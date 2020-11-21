<?php

$error_message ='';
if (isset($_POST['submit'])) {
    

//query the database to check if the user exists


$user_type= htmlspecialchars($_POST['user_type']);
$user = htmlspecialchars($_POST['username']);
$password=htmlspecialchars($_POST['password']);

if ($user_type==''|| $user==''|| $password=='') {
    $error_message='Please enter a valid input!';
}
else{
 // check if the user is valid 





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



