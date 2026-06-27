<?php
session_start();
require 'koneksi.php';

if (isset($_POST['login'])) {
    $user_input = $_POST['user_input']; 
    $password = $_POST['password'];

    $query = "SELECT * FROM tbl_user_annisa WHERE (email=? OR username=?) AND password=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sss", $user_input, $user_input, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        header("Location: home.php");
    } else {
        echo "<script>alert('Email dan Password Salah!'); window.location='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - Annisa 026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-box { background: white; padding: 30px; border-radius: 10px; shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="login-box">
        <h4 class="text-center mb-4">Login APP EXAM</h4>
        <form method="POST">
            <div class="mb-3">
                <label>Username / Email</label>
                <input type="text" name="user_input" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
        </form>
    </div>
</body>
</html>
