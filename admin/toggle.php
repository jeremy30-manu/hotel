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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];

    if ($action === 'add') {
        // Add subcategory to the database
        $sql = "INSERT INTO subcategories (category, subcategory) VALUES ('$category', '$subcategory')";
        if ($conn->query($sql) === TRUE) {
            echo "Subcategory added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action === 'delete') {
        // Delete subcategory from the database
        $sql = "DELETE FROM subcategories WHERE category='$category' AND subcategory='$subcategory'";
        if ($conn->query($sql) === TRUE) {
            echo "Subcategory deleted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Retrieve subcategories from the database
$subcategoriesResult = $conn->query("SELECT * FROM subcategories");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Subcategories</h1>
        
        <form action="admin.php" method="post" class="mb-3">
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="Food">Food</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Liquor">Liquor</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="subcategory" class="form-label">Subcategory</label>
                <input type="text" class="form-control" id="subcategory" name="subcategory" required>
            </div>
            <button type="submit" name="action" value="add" class="btn btn-primary">Add Subcategory</button>
            <button type="submit" name="action" value="delete" class="btn btn-danger">Delete Subcategory</button>
        </form>

        <h2>Existing Subcategories</h2>
        <ul class="list-group">
            <?php while($row = $subcategoriesResult->fetch_assoc()): ?>
                <li class="list-group-item"><?php echo $row['category'] . ': ' . $row['subcategory']; ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
