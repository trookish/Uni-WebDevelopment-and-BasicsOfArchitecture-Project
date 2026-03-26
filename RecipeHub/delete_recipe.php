<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$message = '';
$error = '';

// Handle form submission to delete a recipe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe_id = $_POST['recipe_id'];
    
    // Start a transaction to ensure all deletes are processed together
    $conn->begin_transaction();

    try {
        // Delete related records in the `favorites` table first
        $deleteFavorites = $conn->prepare("DELETE FROM favorites WHERE recipe_id = ?");
        $deleteFavorites->bind_param("i", $recipe_id);
        $deleteFavorites->execute();
        $deleteFavorites->close();

        // Delete the recipe from the `recipes` table
        $deleteRecipe = $conn->prepare("DELETE FROM recipes WHERE id = ?");
        $deleteRecipe->bind_param("i", $recipe_id);
        $deleteRecipe->execute();
        $deleteRecipe->close();

        // Commit the transaction
        $conn->commit();
        $message = "Recipe deleted successfully!";
    } catch (Exception $e) {
        // Rollback the transaction if any error occurs
        $conn->rollback();
        $error = "Error deleting record: " . $conn->error;
    }
}

// Fetch all recipes from the database for selection
$result = $conn->query("SELECT id, title FROM recipes");
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Recipe</title>
    <link rel="stylesheet" href="css/AdminStyles.css">
</head>
<body>
    <div class="container">
        <nav class="navigation">
            <a href="admin_panel.php" class="nav-button">Back</a>
        </nav>
        <h1>Delete Recipe</h1>

        <?php if ($message) echo "<p style='color: green;'>$message</p>"; ?>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>

        <form method="post">
            <label>Select Recipe to Delete:</label>
            <select name="recipe_id" required>
                <option value="">Select...</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Delete Recipe</button>
        </form>
    </div>
</body>
</html>
