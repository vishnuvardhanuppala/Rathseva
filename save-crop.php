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

// Get form data
$farmer_name = $_POST['farmer_name'];
$crop_name = $_POST['crop_name'];
$quantity = $_POST['quantity'];
$warehouse = $_POST['warehouse'];

// Insert data into the database
$sql = "INSERT INTO crop_storage (farmer_name, crop_name, quantity, warehouse)
        VALUES ('$farmer_name', '$crop_name', '$quantity', '$warehouse')";

if ($conn->query($sql) === TRUE) {
    echo "<h1>Data saved successfully!</h1>";
    echo "<a href='store-crop.html' style='text-decoration: none; color: white; background-color: #00796b; padding: 10px 20px; border-radius: 5px;'>Back to Form</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Fetch all data from the database
$sql = "SELECT * FROM crop_storage";
$result = $conn->query($sql);

echo "<h2>Stored Crop Details</h2>";
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