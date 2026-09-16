<?php
require '../../config/config.php';
require '../../config/functions.php';

requireRole('admin');

logActivity(
    $pdo,
    $_SESSION['user_id'],
    $_SESSION['user_email'],
    'view_activity_logs',
    'success'
);

//Activity Logs Query#3
$stmt = $pdo->query("
    SELECT *
    FROM activity_logs
    ORDER BY activity_log_created_at DESC
");

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.8/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/3.0.4/css/dataTables.bootstap5.min.css"/>

    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container-box {
            width: 95%;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            padding: 9px 16px;
            border-radius: 6px;
            font-size: 14px;
        }

        .logout-btn:hover {
            background-color: #bb2d3b;
            color: white;
        }

        .table-container {
            overflow-x: auto;
        }

        #example {
            width: 100% !important;
        }

        #example thead th {
            background-color: #212529;
            color: white;
            white-space: nowrap;
        }

        #example tbody td {
            vertical-align: middle;
            white-space: nowrap;
        }

        .page-title {
            margin-bottom: 20px;
            color: #555;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Welcome Admin</h1>
    <a href="../../auth/signout.php">Sign Out</a>
    <table id="example" class="table table-striped" style="width:auto">
        <thead>
            <tr>
                <th>Record ID</th>
                <th>User D</th>
                <th>User Email</th>
                <th>Action</th>
                <th>Status</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($activities as $activity):?>
                <tr>
                    <td><?= htmlspecialchars($activity['activity_log_id'])?></td>
                    <td><?= htmlspecialchars($activity['user_id'])?></td>
                    <td><?= htmlspecialchars($activity['user_email'])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_action'])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_status'])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_ip_address'])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_user_agent'])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_created_at'])?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.8/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/3.0.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/3.0.4/js/dataTables.bootstap5.min.js"></script>
<script>
    new DataTable('#example',{
        scrolly: '400px',
        autowidth: false,
    });
</script>
</html>