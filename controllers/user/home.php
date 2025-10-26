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

// Update last active users
$stmt = $conn->prepare('UPDATE users SET last_active=NOW() WHERE id_user=?');
$stmt->bind_param('i', $idUser);
$stmt->execute();

// Ambil data note di db
$stmt = $conn->prepare('SELECT * FROM notes WHERE id_user=? ORDER BY created_at DESC');
$stmt->bind_param('i', $idUser);
$stmt->execute();
$result = $stmt->get_result();

function cutText($text, $limit = 100)
{
    if (strlen($text) > $limit) {
        return substr($text, 0, $limit) . '...';
    }
    return $text;
}

?>

<h1 class="text-3xl">Halo, <?= $firstName ?></h1>

<section class="grid grid-cols-4 max-md:grid-cols-1 max-md:gap-4 max-md:mt-4 gap-8 mt-8 max-md:pb-30">
    <?php if ($result->num_rows > 0):
        while ($note = $result->fetch_assoc()):
            list($date, $time) = explode(' ', $note['created_at']);
            list($year, $month, $day) = explode('-', $date);

            $monthList = [
                1 => "Januari",
                2 => "Februari",
                3 => "Maret",
                4 => "April",
                5 => "Mei",
                6 => "Juni",
                7 => "Juli",
                8 => "Agustus",
                9 => "September",
                10 => "Oktober",
                11 => "November",
                12 => "Desember"
            ];


            $fullDateTime = $day . ' ' . $monthList[$month] . ' ' . $year . ', ' . $time;
    ?>
            <div class="group flex flex-col border border-neutral-100 bg-neutral-50 shadow-lg rounded-md p-5">
                <div class="flex w-full justify-between">
                    <p class="text-sm text-neutral-600 mb-4"><?= $fullDateTime ?></p>
                    <a href="<?= $domain . 'edit-notes?id_note=' . $note['id_note'] ?>"><i class="bx bx-edit text-xl text-neutral-600 cursor-pointer opacity-0 pointer-events-none max-md:pointer-events-auto max-md:opacity-100 group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-300 "></i></a>
                </div>
                <div class="flex flex-col gap-1">
                    <h2 class="text-2xl"><?= cutText($note['title'], 18) ?></h2>
                    <p class="text-md max-md:text-sm text-neutral-600"><?= cutText($note['content'], 30) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <div class="flex p-5 items-center justify-center max-md:hidden">
        <a href="<?= $domain ?>add-notes"><i class="bx bx-plus-circle text-7xl text-neutral-300"></i></a>
    </div>
</section>

<?php if ($result->num_rows == 0): ?>
    <div class="hidden max-md:flex absolute top-0 left-0 w-full h-full pointer-events-none items-center justify-center">
        <p class="text-sm text-neutral-600">Catatan Kosong!</p>
    </div>
<?php endif; ?>