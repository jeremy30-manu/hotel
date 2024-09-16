function initializeSearchFunctionality() {
    document.getElementById('searchButton').addEventListener('click', function() {
        var searchInput = document.getElementById('searchInput').value.toLowerCase();
        var foodItems = document.getElementById('foodItems').getElementsByClassName('col');
        var drinkItems = document.getElementById('drinkItems').getElementsByClassName('col');
        
        var items = [];
        if (!document.getElementById('foodItems').classList.contains('d-none')) {
            items = foodItems;
        } else {
            items = drinkItems;
        }
        
        for (var i = 0; i < items.length; i++) {
            var itemTitle = items[i].getElementsByClassName('card-title')[0].innerText.toLowerCase();
            if (itemTitle.includes(searchInput)) {
                items[i].classList.remove('d-none');
            } else {
                items[i].classList.add('d-none');
            }
        }
    });
}

function initializeCategorySwitching() {
    document.getElementById('foodButton').addEventListener('click', function() {
        document.getElementById('foodItems').classList.remove('d-none');
        document.getElementById('drinkItems').classList.add('d-none');
        document.getElementById('searchInput').placeholder = 'Search for food...';
    });

    document.getElementById('drinksButton').addEventListener('click', function() {
        document.getElementById('drinkItems').classList.remove('d-none');
        document.getElementById('foodItems').classList.add('d-none');
        document.getElementById('searchInput').placeholder = 'Search for drinks...';
    });
}

// Initialize all functionalities when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeSearchFunctionality();
    initializeCategorySwitching();
    // Add other initialization functions here
});

document.getElementById('foodButton').addEventListener('click', function() {
    showCategory('foodSubcategories', 'foodItems');
});

document.getElementById('drinksButton').addEventListener('click', function() {
    showCategory('drinkSubcategories', 'drinkItems');
});

document.getElementById('liquorButton').addEventListener('click', function() {
    showCategory('liquorSubcategories', 'liquorItems');
});

document.getElementById('backButton').addEventListener('click', function() {
    // Show all categories
    document.querySelectorAll('.main-content .row').forEach(function(row) {
        row.classList.remove('d-none');
    });
    document.querySelectorAll('.sidebar ul').forEach(function(ul) {
        ul.classList.add('d-none');
    });
    document.getElementById('backButton').classList.add('d-none');
});

document.getElementById('searchButton').addEventListener('click', function() {
    searchItems();
});

document.getElementById('searchInput').addEventListener('input', function() {
    searchItems();
});

function showCategory(subcategoriesId, itemsId) {
    // Show only the selected category and its subcategories
    document.querySelectorAll('.main-content .row').forEach(function(row) {
        row.classList.add('d-none');
    });
    document.getElementById(itemsId).classList.remove('d-none');

    document.querySelectorAll('.sidebar ul').forEach(function(ul) {
        ul.classList.add('d-none');
    });
    document.getElementById(subcategoriesId).classList.remove('d-none');

    document.getElementById('backButton').classList.remove('d-none');
}

function filterItems(itemsId, subcategory) {
    document.querySelectorAll(`#${itemsId} .card`).forEach(function(card) {
        card.parentElement.style.display = card.getAttribute('data-subcategory') === subcategory ? '' : 'none';
    });
}

function searchItems() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();

    document.querySelectorAll('.main-content .card').forEach(function(card) {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const description = card.querySelector('.card-text').textContent.toLowerCase();
        card.parentElement.style.display = title.includes(searchText) || description.includes(searchText) ? '' : 'none';
    });
}
