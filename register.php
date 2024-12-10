<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $kelas = $_POST['kelas'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->rowCount() > 0) {
        echo "Username sudah digunakan!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, kelas, asal_sekolah) VALUES (:username, :password, :email, :kelas, :asal_sekolah)");
        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'kelas' => $kelas,
            'asal_sekolah' => $asal_sekolah
        ]);
        echo "Pendaftaran berhasil!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
</head>
<body>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="kelas" placeholder="Nama Kelas" required><br>
    <input type="text" name="asal_sekolah" placeholder="Asal Sekolah" required><br>
    <button type="submit">Daftar</button>
</form>
</body>
</html>
