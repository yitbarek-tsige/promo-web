<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
include '../db_config.php'; 
$result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
?>



<!DOCTYPE html>
<html lang="en">
<head>

<style>
    .logout-btn {
    background-color: #ff4757;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    font-size: 14px;
    transition: background 0.3s ease;
}

.logout-btn:hover {
    background-color: #ff6b81;
}
</style>


    <meta charset="UTF-8">
    <title>Admin Panel - Orders</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; padding: 40px; }
        .dashboard-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #25D366; color: white; padding: 15px; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid #ddd; }
        .status-badge { padding: 5px 12px; border-radius: 15px; font-size: 12px; font-weight: bold; }
        .Pending { background: #ffeaa7; color: #d6a01d; }
        .Delivered { background: #55efc4; color: #00b894; }
        .Processing { background: #81ecec; color: #00cec9; }
    </style>
</head>
<body>

<div class="dashboard-card">
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>📦 Order Management Dashboard</h2>
    
    <a href="logout.php" class="logout-btn">Logout</a>
</div>
    <table>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Contact</th>
            <th>City</th>
            <th>Address</th>
            <th>Order</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td>#<?php echo $row['id']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['package']; ?></td>
            <td><span class="status-badge <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
            <td>
                <form action="update_status.php" method="POST">
                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                    <select name="new_status" onchange="this.form.submit()">
                        <option value="Pending" <?php if($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Processing" <?php if($row['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                        <option value="Delivered" <?php if($row['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                    </select>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>

