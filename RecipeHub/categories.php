<?php
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Fetch all distinct categories
$sql = "SELECT DISTINCT category FROM recipes";
$categories = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories - Recipe Hub</title>
    <link rel="stylesheet" href="css/GeneralStyles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>Recipe Categories</h1>
        <nav class="navigation">
            <a href="index.php" class="nav-button">Home</a>
            <a href="recipes.php" class="nav-button">Recipes</a>
            <a href="favorites.php" class="nav-button">Favorites</a>
        </nav>
    </header>

    <!-- Category Dropdown -->
    <div class="category-dropdown">
        <select id="category-select" onchange="fetchRecipesByCategory()">
            <option value="">Select a Category</option>
            <?php while ($category = $categories->fetch_assoc()): ?>
                <option value="<?php echo $category['category']; ?>"><?php echo $category['category']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <!-- Recipes Container -->
    <div class="recipe-cards-container" id="recipes-container">
        <!-- Recipes will be displayed here based on the selected category -->
    </div>

    <script>
        // JavaScript function to fetch recipes based on selected category
        function fetchRecipesByCategory() {
            const category = document.getElementById("category-select").value;
            const recipesContainer = document.getElementById("recipes-container");

            if (category) {
                fetch(`fetch_recipes.php?category=${encodeURIComponent(category)}`)
                    .then(response => response.json())
                    .then(data => {
                        recipesContainer.innerHTML = ""; // Clear previous recipes

                        // Display recipes as clickable cards
                        data.forEach(recipe => {
                            const recipeCard = document.createElement("div");
                            recipeCard.classList.add("recipe-card");

                            // Create an anchor element linking to recipe-detail.php
                            const link = document.createElement("a");
                            link.href = `recipe-detail.php?id=${recipe.id}`;
                            link.style.textDecoration = "none";
                            link.style.color = "inherit";

                            const img = document.createElement("img");
                            img.src = recipe.image;
                            img.alt = recipe.title;
                            img.classList.add("recipe-image");

                            const title = document.createElement("h3");
                            title.textContent = recipe.title;

                            // Append image and title to link, then link to recipeCard
                            link.appendChild(img);
                            link.appendChild(title);
                            recipeCard.appendChild(link);
                            recipesContainer.appendChild(recipeCard);
                        });
                    })
                    .catch(error => console.error("Error fetching recipes:", error));
            } else {
                recipesContainer.innerHTML = "<p>Please select a category to view recipes.</p>";
            }
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>
