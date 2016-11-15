<?php
//simple logout

session_start();
session_destroy();

header("Location: logout.html");

?>