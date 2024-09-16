<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Menu Item</h1>
        <form action="add_item.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Food">Food</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Liquor">Liquor</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="subcategory" class="form-label">Subcategory</label>
                <select class="form-select" id="subcategory" name="subcategory" required>
                    <option value="">Select Subcategory</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('category').addEventListener('change', function() {
            var category = this.value;
            var subcategorySelect = document.getElementById('subcategory');
            
            // Clear existing subcategory options
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

            if (category) {
                fetch('fetch_subcategories.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'category=' + encodeURIComponent(category),
                })
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        var option = document.createElement('option');
                        option.value = subcategory;
                        option.textContent = subcategory;
                        subcategorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>
</html>
