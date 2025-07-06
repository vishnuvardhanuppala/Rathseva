<?php
// Database connection
$servername = "localhost"; // Replace with your database server name if different
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "farmers_db";    // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all data from the database
$sql = "SELECT * FROM crop_storage";
$result = $conn->query($sql);

echo "<h1>Stored Crop Details</h1>";
echo "<table border='1' style='width: 100%; text-align: left; border-collapse: collapse;'>
        <tr>
            <th>ID</th>
            <th>Farmer Name</th>
            <th>Crop Name</th>
            <th>Quantity (kg)</th>
            <th>Warehouse</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['farmer_name'] . "</td>
                <td>" . $row['crop_name'] . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>" . $row['warehouse'] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No data found</td></tr>";
}

echo "</table>";

$conn->close();
?>