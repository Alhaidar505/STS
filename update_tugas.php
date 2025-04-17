<?php
session_start();
include('db.php');

if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard_admin.php');
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: todo_list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tugas = $_POST['tugas'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $tugas_untuk = $_POST['tugas_untuk'];
    $status = $_POST['status'];

    $query = "UPDATE tb_todo 
              SET tugas = '$tugas', waktu_mulai = '$waktu_mulai', waktu_selesai = '$waktu_selesai', 
                  tugas_untuk = '$tugas_untuk', status = '$status'
              WHERE id = $id";
    $conn->query($query);
    header('Location: todo_list.php');
    exit;
}

$query = "SELECT * FROM tb_todo WHERE id = $id";
$result = $conn->query($query);
$tugasData = $result->fetch_assoc();

$pegawaiQuery = "SELECT id, nama FROM tb_pegawai WHERE jabatan IN ('ceo', 'pelaksana')";
$pegawaiResult = $conn->query($pegawaiQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Tugas</title>
</head>
<body>
    <h2>Edit Tugas</h2>
    <form method="POST">
        <label>Tugas:</label><br>
        <input type="text" name="tugas" value="<?= $tugasData['tugas'] ?>" required><br><br>

        <label>Waktu Mulai:</label><br>
        <input type="datetime-local" name="waktu_mulai" value="<?= date('Y-m-d\TH:i', strtotime($tugasData['waktu_mulai'])) ?>" required><br><br>

        <label>Waktu Selesai:</label><br>
        <input type="datetime-local" name="waktu_selesai" value="<?= date('Y-m-d\TH:i', strtotime($tugasData['waktu_selesai'])) ?>" required><br><br>

        <label>Tugas Untuk:</label><br>
        <select name="tugas_untuk" required>
            <?php while ($pegawai = $pegawaiResult->fetch_assoc()): ?>
                <option value="<?= $pegawai['id'] ?>" <?= $pegawai['id'] == $tugasData['tugas_untuk'] ? 'selected' : '' ?>>
                    <?= $pegawai['nama'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="belum selesai" <?= $tugasData['status'] == 'belum selesai' ? 'selected' : '' ?>>Belum Selesai</option>
            <option value="sedang dikerjakan" <?= $tugasData['status'] == 'sedang dikerjakan' ? 'selected' : '' ?>>Sedang Dikerjakan</option>
            <option value="selesai" <?= $tugasData['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
        </select><br><br>

        <button type="submit">Update Tugas</button>
    </form>
</body>
</html>
