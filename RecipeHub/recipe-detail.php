<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$recipe_id = $_GET['id'];
$sql = "SELECT title, image, description, ingredients, instructions, rating FROM recipes WHERE id = $recipe_id";
$result = $conn->query($sql);
$recipe = $result->fetch_assoc();

// Fetch reviews
$reviews_sql = "SELECT user_name, rating, comment, created_at FROM reviews WHERE recipe_id = $recipe_id ORDER BY created_at DESC";
$reviews_result = $conn->query($reviews_sql);

// Handle new review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = htmlspecialchars($_POST['user_name']);
    $user_rating = (float)$_POST['rating'];
    $comment = htmlspecialchars($_POST['comment']);

    // Insert the review (no need to update the rating in the database here)
    $insert_review_sql = "INSERT INTO reviews (recipe_id, user_name, rating, comment) VALUES ($recipe_id, '$user_name', $user_rating, '$comment')";
    $conn->query($insert_review_sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($recipe['title']); ?></title>
    <link rel="stylesheet" href="css/GeneralStyles.css">
    <script>
        // JavaScript to refresh the page after form submission
        function submitForm(event) {
            event.preventDefault();  // Prevent the default form submission
            const form = event.target;
            const formData = new FormData(form);

            fetch('', {
                method: 'POST',
                body: formData
            }).then(() => {
                window.location.reload();  // Refresh the page after form submission
            }).catch(error => console.error('Error:', error));
        }
    </script>
</head>
<body>
    <div class="recipe-detail-container">
        <?php if ($recipe): ?>
            <div class="recipe-detail-content">
                <div class="recipe-image-container">
                    <img src="<?php echo htmlspecialchars($recipe['image']); ?>" alt="<?php echo htmlspecialchars($recipe['title']); ?>" class="recipe-detail-image">
                </div>
                <div class="recipe-info">
                <nav class="navigation">
                    <a href="index.php" class="nav-button">Home</a>
                    <a href="recipes.php" class="nav-button">Recipes</a>
                    <a href="favorites.php" class="nav-button">Favorites</a>
                    <a href="categories.php" class="nav-button">Categories</a>
                </nav>
                    <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
                    
                    <!-- Rating Section -->
                    <h2>Rating</h2>
                    <p class="recipe-rating"><?php echo round($recipe['rating'], 1); ?> / 5.0</p>

                    <h2>Description</h2>
                    <p><?php echo nl2br(htmlspecialchars($recipe['description'])); ?></p>
                    
                    <h2>Ingredients</h2>
                    <p><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
                    
                    <h2>Instructions</h2>
                    <p><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
                </div>
            </div>
            <!-- Reviews Section -->
            <div class="reviews-section">
                <!-- Add Review Form -->
                <h3>Leave a Review</h3>
                <form method="post" onsubmit="submitForm(event)">
                    <input type="text" name="user_name" placeholder="Your name" required>
                    <input type="number" name="rating" min="1" max="5" step="0.1" placeholder="Rating (1-5)" required>
                    <textarea name="comment" placeholder="Your review" required></textarea>
                    <button type="submit">Submit Review</button>
                </form>

                <h2>Reviews:</h2>
                <?php if ($reviews_result->num_rows > 0): ?>
                    <?php while ($review = $reviews_result->fetch_assoc()): ?>
                        <div class="review">
                            <strong><?php echo htmlspecialchars($review['user_name']); ?></strong> 
                            <span><?php echo htmlspecialchars($review['rating']); ?> / 5.0</span>
                            <p><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                            <small><?php echo htmlspecialchars($review['created_at']); ?></small>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No reviews yet. Be the first to review!</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Recipe not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
