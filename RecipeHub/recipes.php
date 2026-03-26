<?php
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Check if a search query is provided
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM recipes";
if (!empty($searchQuery)) {
    $searchQuery = $conn->real_escape_string($searchQuery);
    $sql .= " WHERE title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Recipes</title>
    <link rel="stylesheet" href="css/GeneralStyles.css">
</head>
<body>
    <header>
        <h1>All Recipes</h1>
        <form method="get" action="recipes.php">
            <input type="text" id="search-input" name="search" placeholder="Search recipes..." value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Search</button>
        </form>
    </header>

    <nav class="navigation">
            <a href="index.php" class="nav-button">Home</a>
            <a href="favorites.php" class="nav-button">Favorites</a>
            <a href="categories.php" class="nav-button">Categories</a>
        </nav>

    <div class="recipe-cards-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($recipe = $result->fetch_assoc()): ?>
                <div class="recipe-card">
                    <a href="recipe-detail.php?id=<?php echo $recipe['id']; ?>">
                        <img src="<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['title']; ?>" class="recipe-image">
                        <h3><?php echo $recipe['title']; ?></h3>
                    </a>
                    <div class="favorite-container">
                        <form action="favorite.php" method="POST">
                            <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
                            <button type="submit" class="favorite-button">❤️</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No recipes found. Try searching for something else.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
