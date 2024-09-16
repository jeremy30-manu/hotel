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

// Fetch table numbers
$tables = $pdo->query("SELECT table_number FROM tables")->fetchAll(PDO::FETCH_COLUMN);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Welcome to **** Menu</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body>
    <header></header>
    <main>
        <h1>Welcome to our Menu</h1>
        <div class="input-group mb-3">
            <select class="form-select" id="tableNumber">
                <option value="" selected disabled>Select table number</option>
                <?php foreach ($tables as $table): ?>
                    <option value="<?php echo htmlspecialchars($table); ?>"><?php echo htmlspecialchars($table); ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="redirectToMenu()">Submit</button>
        </div>
        <a href="./admin/Add_Menu_item.php">index</a>
    </main>
    <footer></footer>

    <!-- Modal -->
    <div class="modal fade" id="tableNotFoundModal" tabindex="-1" aria-labelledby="tableNotFoundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableNotFoundModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Table not found.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
        function redirectToMenu() {
            const tableNumber = document.getElementById('tableNumber').value;
            if (tableNumber) {
                window.location.href = `./menu/index.php?table=${tableNumber}`;
            } else {
                const modal = new bootstrap.Modal(document.getElementById('tableNotFoundModal'));
                modal.show();
            }
        }
    </script>
</body>
</html>
