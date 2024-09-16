<?php
// Database connection details
$host = 'localhost';
$db   = 'hotel_menu';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Collect form data
$title = $_POST['title'];
$description = $_POST['description'];
$image_url = $_POST['image_url'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];
$price = $_POST['price'];

// Insert data into the database using prepared statements
$sql = "INSERT INTO menu_items (title, description, image_url, category, subcategory, price) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$title, $description, $image_url, $category, $subcategory, $price]);

header("Location: view_menu.php");
?>
