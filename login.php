<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banking System</title>
    <link rel="stylesheet" type="text/css" href="styles/login.css">
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
       
       

        
       
        </form>

    
    
    </main>

    <footer>
    <p>

        &copy Nisarg Patel, Peter Schubert, Geoffrey Lynch, Nathan Carey 2020
    </p>

    
    </footer>




</body>
</html>



