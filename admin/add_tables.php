<?php
// Database connection details
$host = 'localhost';
$db = 'hotel_menu';
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_table'])) {
        $table_number = $_POST['table_number'];
        $sql = "INSERT INTO tables (table_number) VALUES (?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$table_number]);
    } elseif (isset($_POST['delete_table'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM tables WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}

$tables = $pdo->query("SELECT * FROM tables")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Tables</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="table_number" class="form-label">Table Number</label>
                <input type="text" class="form-control" id="table_number" name="table_number" required>
            </div>
            <button type="submit" name="add_table" class="btn btn-primary">Add Table</button>
        </form>

        <h2 class="mt-5">Existing Tables</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Table Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tables as $table): ?>
                    <tr>
                        <th scope="row"><?php echo $table['id']; ?></th>
                        <td><?php echo $table['table_number']; ?></td>
                        <td>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $table['id']; ?>">
                                <button type="submit" name="delete_table" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
