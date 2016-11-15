<?php
    session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == '1')) {
        
        include("connection.php");
        include("stuPage.html");
    }
?>