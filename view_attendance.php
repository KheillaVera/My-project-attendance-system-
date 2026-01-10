<?php
include 'db.php';

// 1. Get search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// 2. The Query (Simplified)
$sql = "SELECT users.fullname, attendance.log_time, attendance.id 
        FROM attendance 
        INNER JOIN users ON users.id = attendance.user_id 
        WHERE users.fullname LIKE '%$search%' 
        ORDER BY attendance.log_time DESC";

$result = $conn->query($sql);

// 3. Check for Errors
if (!$result) {
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        body { font-family: sans-serif; 
            background: #f4f4f4; 
            padding: 20px; 
        }
        .card { background: white; 
            padding: 20px;
             border-radius: 10px;
              box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
            }
        table { width: 100%;
             border-collapse: collapse; 
             margin-top: 20px;
             }
        th, td { border: 1px solid #ddd;
             padding: 12px;
              text-align: left;
             }
        th { background: #007bff;
             color: white;
             }
        .btn-del { color: red;
             font-weight: bold; 
             text-decoration: none;
             }
    </style>
</head>
<body>

<div class="card">
    <h2>Attendance Records</h2>
    
    <form method="GET">
        <input type="text" name="search" placeholder="Search names..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
        <a href="view_attendance.php">Clear</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Check-in Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['log_time']; ?></td>
                    <td>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-del" onclick="return confirm('Delete record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3">No records found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="index.html">← Back to Check-in</a>
</div>

</body>
</html>