<?php
session_start();
include 'services/auth-login.php';

$messageAlert = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($username != '' && $password != '' && $confirmPassword != '') {
        if ($password == $confirmPassword) {
            $stmt = $conn->prepare('SELECT * FROM users WHERE username=?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            $role = 'user';

            if ($result->num_rows > 0) {
                $messageAlert = 'Username Sudah Dipakai';
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare('INSERT INTO users(username, password, name, created_at, role) values(?,?,?,NOW(),?)');
                $stmt->bind_param('ssss', $username, $passwordHash, $fullname, $role);
                $stmt->execute();

                header('location: ' . $domain.'login');
                exit;
            }
        } else {
            $messageAlert = 'Password tidak sama, ketik ulang!';
        }
    } else {
        $messageAlert = 'Username dan Password tidak boleh kosong!';
    }
}

?>




<div class="w-full h-full items-center justify-center flex">
    <form method="POST" class="flex flex-col p-8 w-1/3 max-md:w-95/100 h-8/10 bg-neutral-50 border-2 justify-center border-neutral-100 rounded-md shadow-lg">
        <h1 class="text-center text-3xl mb-10">Daftar | Catatoon</h1>

        <div class="flex gap-2">
            <div class="flex flex-col gap-2 mb-4">
                <label for="username">Username</label>
                <input type="text" class="h-10 w-full border-2 rounded-md border-neutral-200 focus:border-neutral-950 pl-2 py-2" id="username" name="username" required>
            </div>

            <div class="flex flex-col gap-2 mb-4">
                <label for="fullname">Nama Lengkap</label>
                <input type="text" class="h-10 w-full border-2 rounded-md border-neutral-200 focus:border-neutral-950 pl-2 py-2" id="fullname" name="fullname" required>
            </div>
        </div>

        <div class="flex flex-col gap-2 mb-4">
            <label for="password">Password</label>
            <input type="password" class="h-10 w-full border-2 rounded-md border-neutral-200 focus:border-neutral-950 pl-2 py-2" id="password" name="password" required>
        </div>

        <div class="flex flex-col gap-2">
            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" class="h-10 w-full border-2 rounded-md border-neutral-200 focus:border-neutral-950 pl-2 py-2" id="confirm_Password" name="confirm_password" required>
        </div>

        <p class="text-sm my-2 text-red-500"><?= $messageAlert ?></p>
        <button type="submit" class="w-full bg-neutral-950 p-2 text-neutral-50 rounded-md">Daftar</button>
        <p class="text-sm text-center mt-4">Sudah ada akun? Ayo <a class="text-sky-600 cursor-pointer" href="<?= $domain ?>login">Masuk!</a></p>
    </form>
</div>