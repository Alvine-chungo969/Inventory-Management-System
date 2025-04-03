<?php
session_start();

if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
    header("location:index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $id = trim($_POST['id']);
    $password = trim($_POST['password']);

    if (empty($id) || empty($password)) {
        $error = "Both fields are required!";
    } elseif ($id === 'admin' && $password === 'admin') {
        $_SESSION['auth'] = 1;
        header("location:index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/login-bg.jpg');
            background-size: cover;
            background-position: center;
        }
        .card {
            margin-top: 100px;
            background: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card p-4">
            <h3 class="mb-3">Sign In</h3>
            <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form action="" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="id">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
