<?php
session_start();

$name = $_SESSION['nameUser'];
$initialName = substr($name, 0, 1);
?>

<nav class="max-md:hidden flex flex-col w-1/16 h-screen bg-neutral-50 border-r-2 border-r-neutral-200 p-4 items-center">
    <a href="<?= $domain ?>" class="w-fit aspect-square text-neutral-950 my-8 text-3xl flex items-center justify-center">
        <div>
            <i class="bx bx-book"></i>
        </div>
    </a>
    <div class="flex flex-col justify-between h-full">
        <ul class="flex flex-col items-center gap-4">
            <li><a href="<?= $domain ?>"><i class='bx bx-home text-3xl text-neutral-800'></i></a></li>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <li><a href="<?= $domain ?>admin/all-users"><i class='bx bx-desktop text-3xl text-neutral-800'></i> </a></li>
                <li><a href="<?= $domain ?>admin/statistic"><i class='bx bx-bar-chart-square text-3xl text-neutral-800'></i> </a></li>
            <?php endif; ?>
        </ul>
        <ul class="flex flex-col items-center gap-4">
            <li><a href="<?= $domain ?>profile" class="text-2xl h-10 aspect-square rounded-full bg-sky-300 text-neutral-950 font-bold flex items-center justify-center"><?= ucwords($initialName) ?></a></li>
            <li><a href="<?= $domain ?>settings"><i class='bx bx-cog text-3xl text-neutral-800'></i></a></li>
        </ul>
    </div>
</nav>

<nav class="hidden max-md:flex fixed bottom-0 left-0 w-full h-fit py-4 bg-neutral-50 border-t-2 border-t-neutral-200 p-4 items-center">
    <ul class="flex items-center gap-2 justify-evenly w-full h-full">
        <li><a href="<?= $domain ?>"><i class='bx bx-home text-[26px] text-neutral-800'></i></a></li>
        <?php if ($_SESSION['role'] == 'admin'): ?>
            <li><a href="<?= $domain ?>admin/all-users"><i class='bx bx-desktop text-[26px] text-neutral-800'></i> </a></li>
        <?php endif; ?>
        <li><a href="<?= $domain ?>add-notes"><i class='bx bx-plus-circle text-[26px] text-neutral-800'></i></a></li>
        <li><a href="<?= $domain ?>profile"><i class='bx bx-user text-[26px] text-neutral-800'></i></a></li>
        <li><a href="<?= $domain ?>settings"><i class='bx bx-cog text-[26px] text-neutral-800'></i></a></li>
    </ul>

</nav>