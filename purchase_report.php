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

$t = 0;
if (isset($_POST['submit'])) {
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $category_id = intval($_POST['category']);

    $sql = "SELECT * FROM purchase WHERE created_at >= '$starttime' AND created_at <= '$endtime' AND category_id = '$category_id'";
    $res = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Report</title>
</head>
<body>
<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Start (date and time):</label>
        <input type="datetime-local" name="starttime">

        <label>End (date and time):</label>
        <input type="datetime-local" name="endtime">

        <label>Category:</label>
        <select name="category" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="submit">
    </form>

    <h5>Purchase Report</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Total Unit Price</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_POST['submit']) && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $total = $row['unit'] * $row['unitprice'];
                $t += $total;
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['unit']}</td>
                        <td>$total</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
    <?php echo "Total = $t Taka"; ?>
</div>
</body>
</html>
