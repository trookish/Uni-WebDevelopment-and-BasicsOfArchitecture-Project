<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recipe_hub");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the username and password match any record in the admin table
    $stmt = $conn->prepare("SELECT id FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Fetch admin ID
        $stmt->bind_result($admin_id);
        $stmt->fetch();

        // Set session variable
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin_id;

        // Log login in admin_logins table
        $log_stmt = $conn->prepare("INSERT INTO admin_logins (admin_id) VALUES (?)");
        $log_stmt->bind_param("i", $admin_id);
        $log_stmt->execute();
        $log_stmt->close();

        // Redirect to admin panel
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/AdminStyles.css">
</head>
<body>
    <div class="container">
        <nav class="navigation">
            <a href="index.php" class="nav-button">Home</a>
        </nav>
        <h1>Admin Login</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
