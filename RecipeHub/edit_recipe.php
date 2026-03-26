<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Handle form submission for editing the recipe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $recipe_id = $_POST['recipe_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $rating = $_POST['rating'];

    // Handle image upload if provided
    if ($_FILES['image']['name']) {
        $targetDir = __DIR__ . "/Images/";
        $imageName = basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;

        // Move uploaded image to target directory
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "Images/" . $imageName;
        } else {
            $error = "Failed to upload image.";
        }
    } else {
        // If no new image, keep the old image path
        $imagePath = $_POST['existing_image'];
    }

    // Update the recipe details in the database
    $sql = "UPDATE recipes SET title='$name', description='$description', image='$imagePath', ingredients='$ingredients', instructions='$instructions', rating='$rating' WHERE id='$recipe_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Recipe updated successfully!";
    } else {
        $error = "Error updating record: " . $conn->error;
    }
}

// Retrieve all recipes to populate the selection dropdown
$result = $conn->query("SELECT id, title FROM recipes");
$selectedRecipe = null;

// Load the selected recipe for editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_recipe'])) {
    $recipe_id = $_POST['recipe_id'];
    $recipeResult = $conn->query("SELECT * FROM recipes WHERE id='$recipe_id'");
    $selectedRecipe = $recipeResult->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="css/AdminStyles.css">
</head>
<body>
    <div class="container">
        <nav class="navigation">
            <a href="admin_panel.php" class="nav-button">Back</a>
        </nav>
        <h1>Edit Recipe</h1>
        <?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <!-- Recipe Selection Form -->
        <form method="post">
            <label>Select Recipe to Edit:</label>
            <select name="recipe_id" required>
                <option value="">Select...</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php if ($selectedRecipe && $selectedRecipe['id'] == $row['id']) echo 'selected'; ?>>
                        <?php echo $row['title']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="select_recipe">Load Recipe</button>
        </form>

        <!-- Edit Form (Displays only if a recipe is selected) -->
        <?php if ($selectedRecipe): ?>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="recipe_id" value="<?php echo $selectedRecipe['id']; ?>">

                <label>Recipe Name:</label>
                <input type="text" name="name" value="<?php echo $selectedRecipe['title']; ?>" required>

                <label>Description:</label>
                <textarea name="description" rows="3" required><?php echo $selectedRecipe['description']; ?></textarea>

                <label>Ingredients:</label>
                <textarea name="ingredients" rows="3" required><?php echo $selectedRecipe['ingredients']; ?></textarea>

                <label>Instructions:</label>
                <textarea name="instructions" rows="5" required><?php echo $selectedRecipe['instructions']; ?></textarea>

                <label>Rating:</label>
                <input type="number" name="rating" min="1" max="5" value="<?php echo $selectedRecipe['rating']; ?>" required>

                <label>Image:</label>
                <input type="file" name="image">
                <input type="hidden" name="existing_image" value="<?php echo $selectedRecipe['image']; ?>">
                <p>Current Image: <?php echo $selectedRecipe['image']; ?></p>

                <button type="submit" name="edit">Save Changes</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
