<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT username, email, kelas, asal_sekolah FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

if ($user) {
    echo "Welcome, " . htmlspecialchars($user['username']) . "<br>";
    echo "Email: " . htmlspecialchars($user['email']) . "<br>";
    echo "Kelas: " . htmlspecialchars($user['kelas']) . "<br>";
    echo "Asal Sekolah: " . htmlspecialchars($user['asal_sekolah']) . "<br>";
} else {
    echo "User data not found.";
}

echo '<a href="edit_profile.php">Edit Profile</a><br>';
echo '<a href="logout.php">Logout</a>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    
</body>
</html>