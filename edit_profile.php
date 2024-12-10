<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $email = $_POST['email'];
    $kelas = $_POST['kelas'];
    $asal_sekolah = $_POST['asal_sekolah'];

    if ($password) {
        $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, email = :email, kelas = :kelas, asal_sekolah = :asal_sekolah WHERE id = :id");
        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'kelas' => $kelas,
            'asal_sekolah' => $asal_sekolah,
            'id' => $user_id
        ]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, kelas = :kelas, asal_sekolah = :asal_sekolah WHERE id = :id");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'kelas' => $kelas,
            'asal_sekolah' => $asal_sekolah,
            'id' => $user_id
        ]);
    }
    header('Location: dashboard.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 500px;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 15px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #007BFF;
}

button[type="submit"] {
    background-color: #007BFF;
    color: #ffffff;
    padding: 8px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

</style>
<body>
<h2>Edit Profile</h2>
<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>

    <label>New Password:</label><br>
    <input type="password" name="password"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

    <label>Kelas:</label><br>
    <input type="text" name="kelas" value="<?= htmlspecialchars($user['kelas']) ?>" required><br><br>

    <label>Asal Sekolah:</label><br>
    <input type="text" name="asal_sekolah" value="<?= htmlspecialchars($user['asal_sekolah']) ?>" required><br><br>

    <button type="submit">Update Profile</button>
</form>
</body>
</html>
