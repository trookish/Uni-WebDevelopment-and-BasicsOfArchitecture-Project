<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $rating = 1;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = __DIR__ . "/Images/"; // Use absolute path with __DIR__
        $imageName = basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;

        // Check if directory exists and create it if necessary
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "Images/" . $imageName;
            $sql = "INSERT INTO recipes (title, description, image, ingredients, instructions, rating) 
                    VALUES ('$name', '$description', '$imagePath', '$ingredients', '$instructions', $rating)";

            if ($conn->query($sql) === TRUE) {
                $message = "Recipe added successfully!";
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $error = "Failed to move uploaded file. Check directory permissions.";
        }
    } else {
        $error = "Please select an image to upload.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="css/AdminStyles.css">
</head>
<body>
    <div class="container">
        <nav class="navigation">
            <a href="admin_panel.php" class="nav-button">Back</a>
        </nav>
        <h1>Add New Recipe</h1>
        <?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="post" enctype="multipart/form-data">
            <label>Recipe Name:</label>
            <input type="text" name="name" required>

            <label>Description:</label>
            <textarea name="description" rows="3" required></textarea>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" required>

            <label>Ingredients:</label>
            <textarea name="ingredients" rows="3" required></textarea>

            <label>Instructions:</label>
            <textarea name="instructions" rows="5" required></textarea>

            <button type="submit">Add Recipe</button>
        </form>
    </div>
</body>
</html>
