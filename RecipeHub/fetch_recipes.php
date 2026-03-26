<?php
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';

// Fetch recipes for the selected category
$sql = "SELECT * FROM recipes WHERE category='$category'";
$result = $conn->query($sql);

$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

// Return the recipes as JSON
header('Content-Type: application/json');
echo json_encode($recipes);

$conn->close();
