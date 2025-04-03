<?php
    include "header.php";
    include "connection.php";

    // Fetch product data
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

    // Update product
    if (isset($_POST['update_btn'])) {
        $update_id = $_POST['update_id'];
        $name = $_POST['update_name'];
        $des = $_POST['update_des'];
        $unit = $_POST['update_unit'];
        $unitprice = $_POST['update_unitprice'];

        // Prepared statement
        $stmt = $conn->prepare("UPDATE product SET unitprice = ?, name = ?, des = ?, unit = ? WHERE id = ?");
        $stmt->bind_param("dsdsi", $unitprice, $name, $des, $unit, $update_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header('location:index.php');
        }
    }

    // Remove product
    if (isset($_GET['remove'])) {
        $remove_id = $_GET['remove'];
        $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
        $stmt->bind_param("i", $remove_id);
        $stmt->execute();
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager - Alvine</title>
    <!-- Link to external CSS for Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Link to your custom external CSS -->
    <link rel="stylesheet" href="styles.css"> <!-- Assuming your custom styles are in styles.css -->
</head>
<body class="bg-inventory"> <!-- Applying the custom background class from external CSS -->
    <div class="container mt-5">
        <h2 class="text-center mb-4 text-white">Inventory Manager - Alvine</h2>
        <table class="table table-striped table-hover text-white">
            <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Unit Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <tr>
                        <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                        <td><input type="text" name="update_name" value="<?php echo $row['name']; ?>" required class="form-control"></td>
                        <td><input type="text" name="update_des" value="<?php echo $row['des']; ?>" required class="form-control"></td>
                        <td><input type="number" name="update_unit" value="<?php echo $row['unit']; ?>" required class="form-control"></td>
                        <td><input type="number" name="update_unitprice" value="<?php echo $row['unitprice']; ?>" required class="form-control"></td>
                        <td>
                            <button type="submit" name="update_btn" class="btn btn-success">Update</button>
                            <a href="index.php?remove=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                </form>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional, for functionality like dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
