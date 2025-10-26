<?php
include 'services/auth-login.php';

session_unset();
session_destroy();

header('location:'.$domain.'login');
exit;

?>