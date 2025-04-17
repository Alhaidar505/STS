<?php
session_start();
include('db.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pelaksana') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $koneksi = new mysqli("localhost", "root", "", "todolist");

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $stmt = $koneksi->prepare("UPDATE tb_todo SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header('Location: dashboard_pelaksana.php');
        exit;
    } else {
        echo "Gagal update status: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();
    
}
?>
