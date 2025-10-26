<?php
include 'services/admin_auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $role = $_POST['role'];

    $stmt = $conn->prepare('UPDATE users SET role=? WHERE id_user=?');
    $stmt->bind_param('si', $role, $id_user);

    if ($stmt->execute()) {
        $messageAlert = 'Role berhasil diubah';
        header('location: '.$domain.'admin/all-users');
        exit;
    } else {
        $messageAlert = 'Role gagal diubah';
    }
}

?>