<?php
require 'config.php';

$query = "SELECT * FROM importantdata";
$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, you are logged in!</h1>
        <p>Here’s some important data from the database:</p>

        <table class="data-table">
            <tr>
                <th>ID</th>
                <th>Data</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Sample Data 1</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Sample Data 2</td>
            </tr>
        </table>

        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
