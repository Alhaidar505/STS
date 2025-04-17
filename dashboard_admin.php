<?php
session_start();
include('db.php');

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
echo "<h2>Dashboard Admin</h2>";
echo "<p>Selamat datang, " . $_SESSION['username'] . "!</p>";
echo "<a href='membuat_tugas.php'>Tambah Tugas |</a>";
echo "<a href='todo_list.php'>Lihat Daftar Tugas |</a>";
echo "<a href='logout.php'>Logout |</a>";
?>
