<?php
include "header.php";
include "connection.php";

$categories = [];
$categoryQuery = "SELECT * FROM categories";
$categoryResult = $conn->query($categoryQuery);

if ($categoryResult->num_rows > 0) {
    while ($row = $categoryResult->fetch_assoc()) {
        $categories[] = $row;
    }
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $des = mysqli_real_escape_string($conn, $_POST['des']);
    $unit = intval($_POST['unit']);
    $unitprice = floatval($_POST['unitprice']);
    $category_id = intval($_POST['category']);

    if (!empty($name) && !empty($des) && $unit > 0 && $unitprice > 0) {
        $insertsql = "INSERT INTO product(name, des, unit, unitprice, category_id) VALUES ('$name', '$des', '$unit','$unitprice', '$category_id')";
        $insertsql1 = "INSERT INTO purchase(name, des, unit, unitprice, category_id) VALUES ('$name', '$des', '$unit','$unitprice', '$category_id')";

        if ($conn->query($insertsql1) === TRUE && $conn->query($insertsql) === TRUE) {
            echo "<div class='alert alert-success'>New record created successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: {$conn->error}</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Please fill all fields with valid values.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase</title>
</head>
<body>
    <div class="container">
        <h5>Purchase</h5>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label>Category</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Product Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" name="des" required>
            </div>
            <div class="mb-3">
                <label>Unit</label>
                <input type="number" name="unit" min="1" required>
            </div>
            <div class="mb-3">
                <label>Unit Price</label>
                <input type="number" name="unitprice" min="0.01" step="0.01" required>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
