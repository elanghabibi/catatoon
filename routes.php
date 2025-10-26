<?php
return [
    'login' => 'controllers/login.php',
    'register' => 'controllers/register.php',
    'logout' => 'controllers/logout.php',
    

    // User Route
    '' => 'controllers/user/home.php',
    'home' => 'controllers/user/home.php',
    'add-notes' => 'controllers/user/add-notes.php',
    'edit-notes' => 'controllers/user/edit-notes.php',
    'delete-notes' => 'controllers/user/delete-notes.php',
    'profile' => 'controllers/user/profile.php',


    // Admin Route
    'admin' => 'controllers/admin/home.php',
    'admin/home' => 'controllers/admin/home.php',
    'admin/all-users' => 'controllers/admin/all-users.php',
    'admin/change-role' => 'controllers/admin/change-role.php',
    'admin/statistic' => 'controllers/admin/statistic.php',
];
?>