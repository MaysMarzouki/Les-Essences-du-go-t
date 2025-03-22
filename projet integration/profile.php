<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Database connection
try {
    $conn = new PDO("mysql:host=localhost;dbname=notrebase", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch user information
    $sql = "SELECT firstname, lastname, email FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit();
    }

    // Fetch user recipe statistics
    $recipe_sql = "SELECT COUNT(*) AS total_recipes, MAX(title) AS last_recipe FROM recipes WHERE user_id = :user_id";
    $recipe_stmt = $conn->prepare($recipe_sql);
    $recipe_stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $recipe_stmt->execute();
    $recipe_stats = $recipe_stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<div class="profile-container">
    <h2>Welcome, <?= htmlspecialchars($user['firstname']) ?>!</h2>
    <p>We're glad to have you back. Here’s your profile:</p>

    <div class="profile-pic">
        <img src="./img/default-profile.png" alt="Profile Picture" />
    </div>

    <div class="profile-card">
        <p><strong>First Name:</strong> <?= htmlspecialchars($user['firstname']) ?></p>
        <p><strong>Last Name:</strong> <?= htmlspecialchars($user['lastname']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>

    <div class="recipe-stats">
        <p><strong>Total Recipes Added:</strong> <?= $recipe_stats['total_recipes'] ?? 0 ?></p>
        <p><strong>Last Recipe Added:</strong> <?= $recipe_stats['last_recipe'] ?? "N/A" ?></p>
    </div>

    <div class="profile-actions">
        <a href="add_recipe.php" class="action-button">Add Recipe</a>
        <a href="my_recipes.php" class="action-button">View My Recipes</a>
        <a href="edit_profile.php" class="action-button">Edit Profile</a>
    </div>

    <div class="logout-icon">
    <a href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
    </a>
</div>
</div>

<p class="quote">"Good food is the foundation of genuine happiness." – Auguste Escoffier</p>

</body>
</html>
