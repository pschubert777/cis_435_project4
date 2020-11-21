<?php

session_start();


if (isset($_SESSION['userName'])) {
    session_destroy();
}

header('Location:/cis_435_project4');
exit();






?>