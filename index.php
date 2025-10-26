<?php
include 'services/db.php';
include 'services/domain.php';

$url = $_GET['url'] ?? '';

$parts = explode("/", trim($url, "/"));

$page = $parts[0];
$slug = $parts[1] ?? null;

if ($slug) {
    $formattedTitle = ucwords(str_replace("-", " ", $slug));
} else {
    $formattedTitle = ucwords(str_replace("-", " ", $page));
}

$routes = require 'routes.php';

$title = $url == '' ? 'Home' : $formattedTitle;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Catatoon </title>
    <link rel="stylesheet" href="src/css/output.css">
    <link rel="stylesheet" href="../src/css/output.css">
    <link rel="stylesheet" href="../../src/css/output.css">
    <link rel="stylesheet" href="../../../src/css/output.css">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdn.boxicons.com/fonts/brands/boxicons-brands.min.css' rel='stylesheet'>
</head>

<body class="bg-neutral-50 text-neutral-950 w-full min-h-screen flex">


    <?php
    if ($page != 'login' && $page != 'register') {
        include 'includes/nav.php';
    }
    ?>

    <main class="w-15/16 p-8 max-md:w-full max-md:p-4 overflow-y-auto">
        <?php
        if (array_key_exists($url, $routes)) {
            include $routes[$url];
        } else {
            include 'controllers/404.php';
        }
        ?>
    </main>

</body>

</html>