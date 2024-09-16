<?php
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "hotel_menu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = $_POST['category'];

// Retrieve subcategories from the database based on the selected category
$sql = "SELECT DISTINCT subcategory FROM subcategories WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$subcategories = [];
while ($row = $result->fetch_assoc()) {
    $subcategories[] = $row['subcategory'];
}

$stmt->close();
$conn->close();

// Return subcategories as JSON
echo json_encode($subcategories);
?>
