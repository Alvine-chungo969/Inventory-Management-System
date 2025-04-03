// adjust_stock.php
include "auth.php";
requireAdmin();
include "connection.php";

if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $adjustment_type = $_POST['adjustment_type'];
    $quantity = intval($_POST['quantity']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    $sql = "INSERT INTO adjustments (product_id, adjustment_type, quantity, reason) VALUES ('$product_id', '$adjustment_type', '$quantity', '$reason')";
    $conn->query($sql);

    if ($adjustment_type == "Addition") {
        $conn->query("UPDATE product SET unit = unit + $quantity WHERE id = $product_id");
    } else {
        $conn->query("UPDATE product SET unit = unit - $quantity WHERE id = $product_id");
    }

    echo "Stock adjusted successfully!";
}
