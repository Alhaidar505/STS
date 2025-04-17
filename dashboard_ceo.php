<?php
session_start();
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['ceo'])) {
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard <?php echo ucfirst($_SESSION['role']); ?></title>
</head>
<body>
    <h2>Dashboard <?php echo ucfirst($_SESSION['role']); ?></h2>
    <p>Selamat datang, <?php echo $_SESSION['username']; ?>!</p>
    <a href='membuat_tugas.php'>Tambah Tugas Baru</a> 
        <a href='todo_list.php'>Lihat Daftar Tugas</a>
        <a href='logout.php'>Logout</a>
    <hr>
    <?php if ($_SESSION['role'] === 'ceo'): ?>
        
        <p>Anda sebagai <strong>ceo</strong>, Anda dapat mengelola semua tugas dan data pegawai.</p>
    <?php elseif ($_SESSION['role'] === 'ceo'): ?>
    <?php endif; ?>
</body>
</html>
