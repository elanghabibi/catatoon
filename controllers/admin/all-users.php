<?php
include 'services/admin_auth.php';

$stmt = $conn->prepare('SELECT * FROM users ORDER BY id_user DESC');
$stmt->execute();
$resultUser = $stmt->get_result();


?>

<?php if ($resultUser->num_rows > 0): ?>
    <div>
        <div class="">
            <h2 class="text-2xl font-semibold mb-4">Daftar Pengguna</h2>
            <div class="max-md:overflow-x-auto w-full shadow-md">
                <table class="border-collapse w-full max-md:w-[800px] text-left">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Fullname</th>
                            <th class="p-2 border">Username</th>
                            <th class="p-2 border">Last Active</th>
                            <th class="p-2 border">Created At</th>
                            <th class="p-2 border">Note</th>
                            <th class="p-2 border">Role</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $resultUser->fetch_assoc()):
                            $stmt = $conn->prepare('SELECT COUNT(id_note) AS count_note FROM notes WHERE id_user=?');
                            $stmt->bind_param('i', $user['id_user']);
                            $stmt->execute();
                            $resultNote = $stmt->get_result();
                            $note = $resultNote->fetch_assoc();
                        ?>
                            <tr class="hover:bg-gray-100 transition">
                                <td class="p-2 border"><?= $user['id_user'] ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($user['name']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="p-2 border"><?= $user['last_active'] != '' ? $user['last_active'] : 'Akun belum aktif' ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($user['created_at']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($note['count_note']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($user['role']) ?></td>
                                <td class="p-2 border text-center">
                                    <form method="POST" action="change-role" class="inline">
                                        <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                        <select name="role" class="border rounded p-1 text-sm">
                                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-2 py-1 rounded">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
<?php endif; ?>