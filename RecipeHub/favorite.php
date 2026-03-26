<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = 1; // Replace with session user ID if implementing user accounts
$recipe_id = $_POST['recipe_id'];

// Check if this recipe is already in favorites
$sql = "SELECT * FROM favorites WHERE user_id = $user_id AND recipe_id = $recipe_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // If it exists, remove from favorites
    $sql = "DELETE FROM favorites WHERE user_id = $user_id AND recipe_id = $recipe_id";
    $conn->query($sql);
} else {
    // Otherwise, add to favorites
    $sql = "INSERT INTO favorites (user_id, recipe_id) VALUES ($user_id, $recipe_id)";
    $conn->query($sql);
}

$conn->close();
header("Location: index.php"); // Redirect back to the main page
exit();
?>
