<?php include '../header_footer_files/header.php'; ?>

<?php 
    require('../db_include/db_include.php');
    $currentUser = $_SESSION['userType'];
    $error_message ='';

    if (isset($_POST['submit'])) {
        $entered_userType = htmlspecialchars($_POST['userType']);
        $entered_firstName = htmlspecialchars($_POST['firstName']);
        $entered_lastName = htmlspecialchars($_POST['lastName']);
        $entered_userName = htmlspecialchars($_POST['userName']);
        $entered_password = htmlspecialchars($_POST['password']);

        if($entered_firstName=='' || $entered_lastName=='' || $entered_userName=='' || $entered_password=='')
        {
            $error_message='Please enter a valid input';
        } else {
            if ($entered_userType == 'admin')
            {
                $queryInsert = "INSERT INTO admin 
                            (userName, firstName, lastName, password)
                    VALUES
                            (:userName, :firstName, :lastName, :password)";
                $insertStatement = $db->prepare($queryInsert);
                $insertStatement->bindValue(':userName', $entered_userName);
                $insertStatement->bindValue(':firstName', $entered_firstName);
                $insertStatement->bindValue(':lastName', $entered_lastName);
                $insertStatement->bindValue(':password', $entered_password);
                $insertStatement->execute();
                header("location: ../index.php");  
            } else if ($entered_userType == 'customer') {
                $queryInsert = "INSERT INTO customer 
                            (userName, firstName, lastName, password)
                    VALUES
                            (:userName, :firstName, :lastName, :password)";
                $insertStatement = $db->prepare($queryInsert);
                $insertStatement->bindValue(':userName', $entered_userName);
                $insertStatement->bindValue(':firstName', $entered_firstName);
                $insertStatement->bindValue(':lastName', $entered_lastName);
                $insertStatement->bindValue(':password', $entered_password);
                $insertStatement->execute();
                header("location: ../index.php");  
            }
            
        }
    }

        
    ?>
            <!DOCTYPE html>

            <html lang="en">
                <head>
                    <title>
                        Add User
                    </title>
                    <meta charset="UTF-8">
                </head>
                <body>
                    <?php
                        if ($currentUser == 'admin')
                        {
                    ?>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">

                            <section>
                                <label for="userType">User Type:</label>
                                <select id="userType" name="userType">
                                    <option value="admin">Admin</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </section>

                            <section>
                                <label for="firstName">First Name:</label>
                                <input type="text" id="firstName" name="firstName">
                                <br>
                            </section>
                            
                            <section>
                                <label for="lastName">Last Name:</label>
                                <input type="text" id="lastName" name="lastName">
                                <br>
                            </section>
                            
                            <section>
                                <label for="userName">username:</label>
                                <input type="text" id="userName" name="userName">
                                <br>
                            </section> 
                            
                            <section>
                                <label for="password">Password:</label>
                                <input type="text" id="password" name="password">
                                <br>
                            </section>

                            <input type="submit" name="submit" value="Add"><span> <?php echo $error_message?></span><br>
                        </form>
                    <?php
                            } else {
                            ?>
                                <span>Only Admin is allowed to add users</span>
                            <?php
                            }
                    ?>
                </body>
            </html>


        




<?php include '../header_footer_files/footer.php'; ?>