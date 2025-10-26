<?php

include 'services/auth-nologin.php';

$idUser = $_SESSION['idUser'];

$stmt = $conn->prepare('SELECT * FROM users WHERE id_user=?');
$stmt->bind_param('i', $idUser);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

$explodeName = explode(' ', $user['name']);
$firstName = ucwords($explodeName[0]);

?>

<div class="w-full h-full">
    <div class="h-10 w-full flex items-center justify-between mb-4">
        <div class="flex w-fit gap-4 items-center h-full">
            <a href="<?= $domain ?>" class="flex items-center"><i class="bx bx-arrow-left-stroke text-3xl"></i></a>
            <p class="text-xl">@<?= $user['username'] ?></p>
        </div>
        <a href="<?= $domain ?>logout" class="max-md:top-4 max-md:right-4 text-red-500 text-3xl flex items-center gap-1 w-fit"><i class="bx bx-door-open"></i></a>
    </div>

    <div class="flex flex-col w-full gap-4 mt-8">
        <div class="w-fit">
            <?php
            $idUser = $_SESSION['idUser'];

            $stmt = $conn->prepare('SELECT COUNT(*) as count_notes FROM notes WHERE id_user=?');
            $stmt->bind_param('i', $idUser);
            $stmt->execute();
            $result = $stmt->get_result();
            $note = $result->fetch_assoc();

            $countNote = $note['count_notes'];

            ?>
            <div class="w-fit h-fit flex flex-col items-center">
                <h3 class="text-xl"><?= $countNote ?></h3>
                <h4 class="text-lg">Note</h4>
            </div>
        </div>
        <div class="w-fit flex flex-col gap-2">
            <h2 class="text-4xl"><?= $user['name'] ?></h2>
            <p class="text-md">@<?= $user['username'] ?></p>
            <p class="text-md">ID: <?= $user['id_user'] ?></p>
        </div>
    </div>

</div>