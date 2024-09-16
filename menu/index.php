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

$foodItemsSql = "SELECT * FROM menu_items WHERE category='Food'";
$drinkItemsSql = "SELECT * FROM menu_items WHERE category='Drinks'";
$liquorItemsSql = "SELECT * FROM menu_items WHERE category='Liquor'";

$foodItemsResult = $conn->query($foodItemsSql);
$drinkItemsResult = $conn->query($drinkItemsSql);
$liquorItemsResult = $conn->query($liquorItemsSql);

// Retrieve subcategories from the database
$subcategoriesResult = $conn->query("SELECT * FROM subcategories");

$subcategories = [];
while ($row = $subcategoriesResult->fetch_assoc()) {
    $subcategories[$row['category']][] = $row['subcategory'];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Menu</title>
    <link rel="stylesheet" href="content.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h5>Menu Categories</h5>
        <a href="#" class="btn btn-primary mb-3" id="foodButton">Food</a>
        <ul id="foodSubcategories" class="d-none">
            <?php if (isset($subcategories['Food'])): ?>
                <?php foreach ($subcategories['Food'] as $subcategory): ?>
                    <li><a href="#" onclick="filterItems('foodItems', '<?php echo $subcategory; ?>')"><?php echo $subcategory; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <a href="#" class="btn btn-warning mb-3" id="drinksButton">Drinks</a>
        <ul id="drinkSubcategories" class="d-none">
            <?php if (isset($subcategories['Drinks'])): ?>
                <?php foreach ($subcategories['Drinks'] as $subcategory): ?>
                    <li><a href="#" onclick="filterItems('drinkItems', '<?php echo $subcategory; ?>')"><?php echo $subcategory; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <a href="#" class="btn btn-danger mb-3" id="liquorButton">Liquor</a>
        <ul id="liquorSubcategories" class="d-none">
            <?php if (isset($subcategories['Liquor'])): ?>
                <?php foreach ($subcategories['Liquor'] as $subcategory): ?>
                    <li><a href="#" onclick="filterItems('liquorItems', '<?php echo $subcategory; ?>')"><?php echo $subcategory; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <a href="index.php " id="backButton" class="btn btn-secondary mb-3 d-none">Back</a>
    </div>

    <div class="main-content">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Search for items..." aria-label="Search for items">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="foodItems">
            <?php if ($foodItemsResult->num_rows > 0) : ?>
                <?php while($row = $foodItemsResult->fetch_assoc()) : ?>
                    <div class="col">
                        <div class="card" data-subcategory="<?php echo $row['subcategory']; ?>">
                            <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text"><strong>Price: </strong><?php echo $row['price']; ?></p>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Plates" aria-label="Number of plates">
                                </div>
                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No food items found.</p>
            <?php endif; ?>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 d-none" id="drinkItems">
            <?php if ($drinkItemsResult->num_rows > 0) : ?>
                <?php while($row = $drinkItemsResult->fetch_assoc()) : ?>
                    <div class="col">
                        <div class="card" data-subcategory="<?php echo $row['subcategory']; ?>">
                            <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text"><strong>Price: </strong><?php echo $row['price']; ?></p>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Bottles" aria-label="Number of bottles">
                                </div>
                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No drink items found.</p>
            <?php endif; ?>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 d-none" id="liquorItems">
            <?php if ($liquorItemsResult->num_rows > 0) : ?>
                <?php while($row = $liquorItemsResult->fetch_assoc()) : ?>
                    <div class="col">
                        <div class="card" data-subcategory="<?php echo $row['subcategory']; ?>">
                            <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text"><strong>Price: </strong><?php echo $row['price']; ?></p>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Bottles" aria-label="Number of bottles">
                                </div>
                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No liquor items found.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
