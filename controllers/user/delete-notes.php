<?php 
if (isset($_GET['id_note'])) {
    $id_note = $_GET['id_note'];
    $id_user = $_SESSION['idUser'];
    $stmt = $conn->prepare('DELETE FROM notes WHERE id_note=? AND id_user=?');
    $stmt->bind_param('ii', $id_note, $id_user);

    if ($stmt->execute()) {
        $messageAlert = 'Catatan berhasil dihapus';
        header('location: '.$domain);
        exit;
    } else {
        $messageAlert = 'Catatan gagal dihapus';
    }
}


?>