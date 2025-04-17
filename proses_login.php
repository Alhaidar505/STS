<?php
session_start();

$users = [
    'admin1' => ['password' => 'adminpass', 'role' => 'admin'],
    'ceo1' => ['password' => 'ceopass', 'role' => 'ceo'],
    'pelaksana1' => ['password' => 'pelaksanapass', 'role' => 'pelaksana']
];

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($users[$username]) && $users[$username]['password'] === $password) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $users[$username]['role'];
} else {
    $_SESSION['error'] = 'Username atau password salah!';
    header('Location: login.php');
}
exit;

<?php
session_start();
error_log("Received POST data: " . print_r($_POST, true));

$users = [
    'admin1' => ['password' => 'adminpass', 'role' => 'admin'],
    'ceo1' => ['password' => 'ceopass', 'role' => 'ceo'],
    'pelaksana1' => ['password' => 'pelaksanapass', 'role' => 'pelaksana']
];

$username = $_POST['username'];
$password = $_POST['password'];
error_log("Received username: $username, password: $password");

if (isset($users[$username]) && $users[$username]['password'] === $password) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $users[$username]['role'];

   
    error_log("User authenticated. Role: " . $_SESSION['role']);

    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: dashboard_admin.php');
            break;
        case 'ceo':
            header('Location: dashboard_ceo.php');
            break;
        case 'pelaksana':
            header('Location: dashboard_pelaksana.php');
            break;
    }
} else {
    $_SESSION['error'] = 'Username atau password salah!';
    error_log("Authentication failed for username: $username");
    header('Location: login.php');
}
exit;



