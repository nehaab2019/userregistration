<?php
// clear all the session variables and redirect to userregistration page
session_start();
session_unset();
session_write_close();
$url = "./user-registration.php";
header("Location: $url");
?>