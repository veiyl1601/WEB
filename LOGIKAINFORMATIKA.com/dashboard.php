<?php
session_start();

// Kalau belum login, lempar ke login
if (!isset($_SESSION["is_login"])) {
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | LOGIKA INFORMATIKA</title>
    <link rel="stylesheet" href="layout/style.css">
</head>
<body>

<div class="landing-wrapper">
    <div class="landing-card">
        <h1 class="landing-title">Dashboard</h1>
        <p class="landing-subtitle">
            Halo, <b><?= htmlspecialchars($username) ?></b> 👋<br>
            Kamu berhasil login ke sistem.
        </p>

        <div class="landing-buttons">
            <a href="index.php" class="btn-outline">Ke Home</a>
            <a href="logout.php" class="btn-primary">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
