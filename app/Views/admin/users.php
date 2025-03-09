<h2>Daftar User</h2>
<table class="table">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['name']; ?></td>
        <td><?= $user['email']; ?></td>
        <td><?= ucfirst($user['role']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
