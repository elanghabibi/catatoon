<?php
include 'services/auth-nologin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_SESSION['idUser'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $stmt = $conn->prepare('INSERT INTO notes(id_user, title, content, created_at) values(?,?,?,NOW())');
    $stmt->bind_param('iss', $idUser, $title, $content);

    if ($stmt->execute()) {
        $messageAlert = 'Catatan berhasil dibuat';
        header('Location:' . $domain);
        exit;
    } else {
        $messageAlert = 'Catatan gagal dibuat';
    }
}

?>

<div class="h-full w-full flex flex-col gap-4">
    <div class="flex w-fit gap-4 items-center h-fit">
        <a href="<?= $domain ?>" class="flex items-center"><i class="bx bx-arrow-left-stroke text-3xl"></i></a>
        <h2 class="text-3xl">Tambah Catatan</h1>
    </div>
    <form method="POST" class="flex flex-col max-md:gap-4 gap-8">
        <input type="text" placeholder="Isi Judul" name="title" class="h-[10vh] px-4 bg-neutral-50 shadow-md border border-neutral-100 rounded-md outline-none text-2xl" required>
        <textarea name="content" id="content" placeholder="Isi catatan disini" class="resize-none min-h-[50vh] p-4 bg-neutral-50 shadow-md border border-neutral-100 rounded-md outline-none text-lg" required></textarea>

        <button type="submit" class="flex items-center justify-center cursor-pointer w-full h-fit bg-neutral-950 text-neutral-50 py-2 rounded-md"><i class="bx bx-plus text-xl"></i></button>
    </form>
</div>