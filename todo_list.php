<?php
session_start();
include('db.php');

$query = "SELECT tb_todo.*, tb_pegawai.nama AS nama_pegawai 
          FROM tb_todo 
          JOIN tb_pegawai ON tb_todo.tugas_untuk = tb_pegawai.id";
$todos = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar To Do List</title>
</head>
<body>
    <h2>TO DO LIST</h2>
    <a href="membuat_tugas.php">+ Tambah Tugas Baru</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tugas</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Dari</th>
                <th>Untuk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $todos->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['tugas'] ?></td>
                    <td><?= $row['waktu_mulai'] ?></td>
                    <td><?= $row['waktu_selesai'] ?></td>
                    <td><?= $row['tugas_dari'] ?></td>
                    <td><?= $row['nama_pegawai'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <a href="update_tugas.php?id=<?= $row['id'] ?>">Edit</a> | 
                        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
