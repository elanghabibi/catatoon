<?php
include 'services/auth-nologin.php';
$id_user = $_SESSION['idUser'];

if (isset($_GET['id_note'])) {
    $stmt = $conn->prepare('SELECT * FROM notes WHERE id_note=?');
    $id_note = $_GET['id_note'];
    $stmt->bind_param('i', $id_note);
    $stmt->execute();
    $result = $stmt->get_result();
    $note = $result->fetch_assoc();
}

if ($note['id_user'] != $id_user) {
    header('location: '.$domain);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $stmt = $conn->prepare('UPDATE notes SET title=?, content=?, created_at=NOW() WHERE id_note=? and id_user=?');
    $stmt->bind_param('ssii', $title, $content, $id_note, $id_user);

    if ($stmt->execute()) {
        header('Location:' . $domain);
        exit;
    } else {
        $messageAlert = "Gagal memperbarui catatan";
    }
}
?>



<div>
    <div class="h-10 w-full flex items-center justify-between mb-4">
        <div class="flex w-fit gap-4 items-center h-full">
            <a href="<?= $domain ?>" class="flex items-center"><i class="bx bx-arrow-left-stroke text-3xl"></i></a>
            <h2 class="text-3xl">Edit Catatan</h2>
        </div>
        <a href="<?= $domain.'delete-notes?id_note='.$id_note ?>"><i class="bx bx-trash text-2xl cursor-pointer text-red-600"></i></a>
    </div>
    <form method="POST" class="flex flex-col max-md:gap-4 gap-8">
        <input type="text" placeholder="Isi Judul" name="title" required value="<?= htmlspecialchars($note['title']) ?>" class="h-[10vh] px-4 bg-neutral-50 shadow-md border border-neutral-100 rounded-md outline-none text-2xl">
        <textarea name="content" id="content" placeholder="Isi catatan disini" class="resize-none min-h-[50vh] p-4 bg-neutral-50 shadow-md border border-neutral-100 rounded-md outline-none text-lg"><?= htmlspecialchars($note['content']) ?></textarea>

        <button type="submit" class="bg-neutral-950 text-neutral-50 px-4 py-2 rounded cursor-pointer">Simpan Perubahan</button>
    </form>
</div>