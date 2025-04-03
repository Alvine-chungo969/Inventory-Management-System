<?php
include 'header.php';
include 'connection.php';
$t = 0;

if (isset($_POST['submit'])) {
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    $sql = "SELECT * FROM sales WHERE created_at >= '$starttime' AND created_at < '$endtime'";
    $result = $conn->query($sql);
}
?>

<div class="container mt-4">
    <h4>Generate Sales Report</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="mb-3">
        <div class="row">
            <div class="col-md-5">
                <label for="starttime">Start (date and time):</label>
                <input type="datetime-local" id="starttime" name="starttime" class="form-control" required>
            </div>
            <div class="col-md-5">
                <label for="endtime">End (date and time):</label>
                <input type="datetime-local" id="endtime" name="endtime" class="form-control" required>
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
            </div>
        </div>
    </form>

    <button type="button" onclick="window.print();" class="btn btn-secondary mb-3">Print Report</button>

    <h5>Sales Report</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Units Sold</th>
                <th>Total Price (Taka)</th>
                <th>Date of Sale</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['submit'])) {
                $t = 0;
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $t += $row['totalprice'];
                        ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['sellunit']; ?></td>
                            <td><?php echo $row['totalprice']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="4">No sales found for the selected period.</td></tr>';
                }
            }
            ?>
        </tbody>
    </table>
    <?php if (isset($_POST['submit'])) { echo "<h6>Total Sales: $t Taka</h6>"; } ?>
</div>
