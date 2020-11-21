<?php

    $dsn = 'mysql:host=localhost;dbname=bank_system_db';  
    $username = 'bank_user3';
    $password = 'pa55word';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        
        exit();
    }



?>