<?php
session_start();

// Enhanced session security
if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">Inventory Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Stock</a></li>
                <li class="nav-item"><a class="nav-link" href="purchase.php">Purchase</a></li>
                <li class="nav-item"><a class="nav-link" href="sales.php">Sales</a></li>
                <li class="nav-item"><a class="nav-link" href="purchase_report.php">Purchase Report</a></li>
                <li class="nav-item"><a class="nav-link" href="sales_report.php">Sales Report</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
