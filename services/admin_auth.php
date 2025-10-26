<?php

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
    header('Location: '.$domain.'login');
    exit;
}

if ($_SESSION['role'] == 'user') {
    http_response_code(403);
    header('Location: '.$domain);
    exit;
}
?>