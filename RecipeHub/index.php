<?php
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT * FROM recipes";  // Retrieve all recipes from the database
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipe Hub</title>
    <link rel="stylesheet" href="css/GeneralStyles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>Recipe Hub</h1>
        <h2 class="animated-title">Discover Delicious Recipes</h2>
        
        <!-- Navigation Buttons -->
        <nav class="navigation">
            <a href="about_us.php" class="nav-button">About us</a>
            <a href="recipes.php" class="nav-button">Recipes</a>
            <a href="favorites.php" class="nav-button">Favorites</a>
            <a href="categories.php" class="nav-button">Categories</a>
        </nav>

        <nav class="navigation">
            <a href="admin_login.php" class="nav-button">Admin Login</a>
        </nav>
    </header>

    <div class="container">
        <div class="banner" id="banner">
            <?php while ($recipe = $result->fetch_assoc()): ?>
                <div class="recipe-banner">
                        <img src="<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['title']; ?>">
                        <h3><?php echo $recipe['title']; ?></h3>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>