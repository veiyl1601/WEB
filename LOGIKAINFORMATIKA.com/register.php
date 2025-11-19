<?php
include "service/database.php";
session_start();

$register_message = "";

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
    exit;
}

if (isset($_POST['register'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === "" || $password === "") {
        $register_message = "Username dan password tidak boleh kosong";
    } else {
        try {
            // Simpan password apa adanya (tanpa hash)
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            $result = $db->query($sql);

            if ($result) {
                $register_message = "Akun berhasil dibuat, silakan login";
            } else {
                $register_message = "Gagal mendaftar, coba lagi";
            }
        } catch (mysqli_sql_exception $e) {
            $register_message = "Username sudah digunakan";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | LOGIKA INFORMATIKA</title>
    <link rel="stylesheet" href="layout/style.css">
</head>
<body>

<div class="landing-wrapper">
    <div class="landing-card">
        <h1 class="landing-title">Register</h1>
        <p class="landing-subtitle">Buat akun baru untuk mengakses dashboard.</p>

        <?php if ($register_message !== ""): ?>
            <p class="message"><?= $register_message ?></p>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <input 
                type="text" 
                name="username" 
                placeholder="Username" 
                class="input-field"
                required
            >
            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                class="input-field"
                required
            >

            <button 
                type="submit" 
                name="register" 
                class="btn-primary" 
                style="width:100%; margin-top:20px;"
            >
                Daftar Sekarang
            </button>

            <p style="margin-top:16px; font-size:14px; text-align:center;">
                Sudah punya akun?
                <a href="login.php">Login di sini</a>
            </p>
        </form>

    </div>
</div>

</body>
</html>
