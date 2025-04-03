// dashboard.php
include "auth.php";
include "connection.php";

$total_products = $conn->query("SELECT COUNT(*) AS count FROM product")->fetch_assoc()['count'];
$total_sales = $conn->query("SELECT SUM(totalprice) AS total FROM sales")->fetch_assoc()['total'];
$total_purchases = $conn->query("SELECT SUM(unit * unitprice) AS total FROM purchase")->fetch_assoc()['total'];
?>

<h2>Dashboard</h2>
<p>Total Products: <?php echo $total_products; ?></p>
<p>Total Sales: <?php echo $total_sales; ?></p>
<p>Total Purchases: <?php echo $total_purchases; ?></p>
