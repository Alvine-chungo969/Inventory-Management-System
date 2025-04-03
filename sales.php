<?php
    include "header.php";
    include "connection.php";

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $des = $_POST['des'];
    $unit = $_POST['unit'];
    $unitprice = $_POST['unitprice'];
    $unitsale = $_POST['unitsale'];
    $totalprice = $unitprice * $unitsale;
    $u_unit = $unit - $unitsale;

    if ($unit >= $unitsale) {
        $insertsql = "INSERT INTO sales(name, sellunit, totalprice, productid) VALUES ('$name', '$unitsale', '$totalprice','$id')";
        $update_quantity_query = "UPDATE product SET unit = '$u_unit' WHERE id = '$id'";

        if ($conn->query($insertsql) === TRUE && $conn->query($update_quantity_query) === TRUE) {
            echo "<div class='alert alert-success'>Sale recorded successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: {$conn->error}</div>";
        }

        header('location:sales.php');
    } else {
        echo "<div class='alert alert-warning'>Out Of Stock</div>";
    }
}
?>

<html>
<head>
    <title>Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3 class="mb-4">Product Sales</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Available Units</th>
                    <th>Unit Price (Ksh)</th>
                    <th>Units to Sell</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <tr>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="des" value="<?php echo $row['des']; ?>">
                                <input type="hidden" name="unit" value="<?php echo $row['unit']; ?>">
                                <input type="hidden" name="unitprice" value="<?php echo $row['unitprice']; ?>">
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['des']; ?></td>
                                <td><?php echo $row['unit']; ?></td>
                                <td><?php echo $row['unitprice']; ?></td>
                                <td><input type="number" name="unitsale" class="form-control" min="1" max="<?php echo $row['unit']; ?>" required></td>
                                <td><button type="submit" class="btn btn-success" name="submit">Sell Now</button></td>
                            </tr>
                        </form>
                <?php }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No products available</td></tr>";
                } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
