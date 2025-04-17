<?php
session_start();
include('db.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tugas = $_POST['tugas'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $tugas_dari = $_SESSION['username'];
    $tugas_untuk = $_POST['tugas_untuk'];
    $status = $_POST['status'];

    $query = "INSERT INTO tb_todo (tugas, waktu_mulai, waktu_selesai, tugas_dari, tugas_untuk, status)
              VALUES ('$tugas', '$waktu_mulai', '$waktu_selesai', '$tugas_dari', '$tugas_untuk', '$status')";

    if ($conn->query($query)) {
        header('Location: todo_list.php'); 
        exit;
    } else {
        echo "Gagal menambahkan tugas: " . $conn->error;
    }
}


$pegawaiResult = $conn->query("SELECT id, nama FROM tb_pegawai");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
</head>
<body>
    <h2>Tambah Tugas</h2>
    <hr>
    <form method="POST">
        <label>Tugas:</label><br>
        <input type="text" name="tugas" required><br>

        <label>Waktu Mulai:</label><br>
        <input type="datetime-local" name="waktu_mulai" required><br><br>

        <label>Waktu Selesai:</label><br>
        <input type="datetime-local" name="waktu_selesai" required><br><br>

        <label>Tugas Untuk (Pilih Pegawai):</label><br>
        <select name="tugas_untuk" required>
            <option value="">--Pilih Pegawai--</option>
            <?php while ($row = $pegawaiResult->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="diberikan">Diberikan</option>
            <option value="dikerjakan">Dikerjakan</option>
            <option value="selesai">Selesai</option>
            <option value="ditolak">Ditolak</option>
        </select><br><br>

        <button type="submit">Tambah</button>
    </form>
</
