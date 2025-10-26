<?php
include 'services/admin_auth.php';
?>

<div class="flex flex-col gap-4">
    <h2 class="text-2xl font-semibold mb-4">Statistik Penggunaan</h2>
    <div class="grid grid-cols-4 max-md:grid-cols-2 max-md:gap-4 max-md:mb-4 gap-8 mb-8">
        <div class="h-30 rounded-md bg-neutral-50 shadow-md py-4 gap-4 w-full flex flex-col items-center justify-center border border-neutral-100">
            <h3 class="text-lg">Total User (All Time)</h3>
            <?php

            $stmt = $conn->prepare('SELECT COUNT(*) as total_users FROM users');
            $stmt->execute();
            $result = $stmt->get_result();

            if ($user = $result->fetch_assoc()): ?>
                <h4 class="text-4xl text-neutral-600"><?= $user['total_users']; ?></h4>
            <?php endif; ?>
        </div>

        <div class="h-30 rounded-md bg-neutral-50 shadow-md py-4 gap-4 w-full flex flex-col items-center justify-center border border-neutral-100">
            <h3 class="text-lg">Total Catatan (All Time)</h3>
            <?php

            $stmt = $conn->prepare('SELECT COUNT(*) as total_notes FROM notes');
            $stmt->execute();
            $result = $stmt->get_result();

            if ($note = $result->fetch_assoc()): ?>
                <h4 class="text-4xl text-neutral-600"><?= $note['total_notes']; ?></h4>
            <?php endif; ?>
        </div>

        <div class="h-30 rounded-md bg-neutral-50 shadow-md py-4 gap-4 w-full flex flex-col items-center justify-center border border-neutral-100">
            <h3 class="text-lg">Total Catatan (Hari Ini)</h3>
            <?php

            $stmt = $conn->prepare('SELECT COUNT(*) as total_notes_today FROM notes WHERE DATE(created_at)=CURDATE()');
            $stmt->execute();
            $result = $stmt->get_result();

            if ($note = $result->fetch_assoc()): ?>
                <h4 class="text-4xl text-neutral-600"><?= $note['total_notes_today']; ?></h4>
            <?php endif; ?>
        </div>
    </div>
</div>