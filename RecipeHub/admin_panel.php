<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/AdminStyles.css">
</head>
<body>
    <div class="container">
        <nav class="navigation">
            <a href="logout.php" class="nav-button">Log out</a> <!-- Updated to logout.php -->
        </nav>
        <h1>Admin Control Panel</h1>
        <div class="admin-links">
            <a href="add_recipe.php">Add Recipe</a>
            <a href="delete_recipe.php">Delete Recipe</a>
            <a href="edit_recipe.php">Edit Recipe</a>
        </div>
    </div>
</body>
</html>
