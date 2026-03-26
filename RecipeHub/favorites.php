<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = 1; // Replace with session user ID if implementing user accounts

// Fetch all favorite recipes for this user
$sql = "SELECT recipes.* FROM recipes 
        JOIN favorites ON recipes.id = favorites.recipe_id 
        WHERE favorites.user_id = $user_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Favorite Recipes</title>
    <link rel="stylesheet" href="css/GeneralStyles.css">
</head>
<body>
    <header>
        <h1>My Favorite Recipes</h1>
    </header>

    <nav class="navigation">
            <a href="index.php" class="nav-button">Home</a>
            <a href="recipes.php" class="nav-button">Recipes</a>
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
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No favorite recipes yet. Add some from the <a href="recipes.php">Recipes</a> page!</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
