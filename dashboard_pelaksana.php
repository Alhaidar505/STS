<?php
session_start();
include('db.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pelaksana') {
    header('Location: login.php');
    exit;
}


$koneksi = new mysqli("localhost", "root", "", "todolist");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$username = $_SESSION['username'];
$query = "SELECT * FROM tugas WHERE pelaksana_username = ?";
$stmt = $koneksi->prepare($query);

if (!$stmt) {
    die("Prepare statement gagal: " . $koneksi->error);
}

$stmt->bind_param("s", $username);

if (!$stmt->execute()) {
    die("Eksekusi query gagal: " . $stmt->error);
}

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelaksana</title>
</head>
<body>
    <h2>Dashboard Pelaksana</h2>
    <p>Selamat datang, <?php echo htmlspecialchars($username); ?>!</p>
    <p><a href="ubah_status.php">Kerjakan!</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>

<?php
if (isset($stmt)) {
    $stmt->close();
}

if (isset($koneksi)) {
    $koneksi->close();
}
?>
