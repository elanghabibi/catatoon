<?php
session_start();
include 'services/auth-login.php';
$messageAlert = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE username=?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Update last active users
            $stmt = $conn->prepare('UPDATE users SET last_active=NOW() WHERE id_user=?');
            $stmt->bind_param('i', $user['id_user']);
            $stmt->execute();

            $_SESSION['idUser'] = $user['id_user'];
            $_SESSION['nameUser'] = $user['name'];
            $_SESSION['isLogin'] = true;
            $_SESSION['role'] = $user['role'];
            header('location: ' . $domain);
            exit;
        } else {
            $messageAlert = 'Password Salah';
        }
    } else {
        $messageAlert = 'Username tidak ditemukan!';
    }
}

?>

<div class="w-full h-full items-center justify-center flex">
    <form method="POST" class="flex flex-col p-8 w-1/3 max-md:w-95/100 h-8/10 bg-neutral-50 border-2 justify-center border-neutral-100 rounded-md shadow-lg">
        <h1 class="text-center text-3xl mb-12">Masuk | Catatoon</h1>

        <div class="flex flex-col gap-2 mb-8">
            <label for="username">Username</label>
            <input class="h-10 w-full border-2 rounded-md border-neutral-200 focus:border-neutral-950 pl-2 py-2" type="text" name="username" id="username">
        </div>

        <div class="flex flex-col gap-2">
            <label for="password">Password</label>
            <input class="h-10 w-full border-2 rounded-md border-neutral-200 focus:border-neutral-950 pl-2 py-2" type="password" name="password" id="password">
        </div>

        <p class='text-sm text-red-500 my-4'><?= $messageAlert ?></p>
        <button type="submit" class="w-full bg-neutral-950 p-2 text-neutral-50 rounded-md">Masuk</button>
        <p class="text-sm text-center mt-4">Belum punya akun? Ayo <a class="text-sky-600 cursor-pointer" href="<?= $domain ?>register">Daftar!</a></p>
    </form>
</div>