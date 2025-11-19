<?php
include "service/database.php";
session_start();

$login_message = "";

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username dan password langsung (tanpa hash)
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db->query($sql);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $_SESSION["username"] = $data["username"];
        $_SESSION["is_login"] = true;

        header("location: dashboard.php");
        exit;
    } else {
        $login_message = "Username atau password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LOGIKA INFORMATIKA</title>
    <link rel="stylesheet" href="layout/style.css">
</head>
<body>

<div class="landing-wrapper">
    <div class="landing-card">

        <h1 class="landing-title">Login</h1>
        <p class="landing-subtitle">Masukkan username dan password.</p>

        <?php if ($login_message !== ""): ?>
            <p class="message"><?= $login_message ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input 
                type="text" 
                name="username" 
                class="input-field" 
                placeholder="Username" 
                required
            >
            <input 
                type="password" 
                name="password" 
                class="input-field" 
                placeholder="Password" 
                required
            >

            <button 
                type="submit" 
                name="login" 
                class="btn-primary" 
                style="width:100%; margin-top:20px;"
            >
                Login
            </button>

            <p style="margin-top:16px; font-size:14px; text-align:center;">
                Belum punya akun?
                <a href="register.php">Daftar di sini</a>
            </p>
        </form>

    </div>
</div>

</body>
</html>
