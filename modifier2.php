<?php 

session_reset();
session_start();

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'notrebase';
$user = 'root';
$password = '';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


try {
    // Step 1: Fetch the recipe ID based on the recipe name stored in session
    $query2 = "SELECT id FROM recipes WHERE title = :recipename";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute(['recipename' => $_SESSION["nomrecette"]]); // Proper parameter binding

    $result1 = $stmt2->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array

    // Step 2: Initialize recipe variable
    $recipe = null;

    // Step 3: Check if a result was found and fetch the corresponding recipe details
    if ($result1) {
        $query3 = "SELECT * FROM recipes WHERE id = :id";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute(['id' => $result1["id"]]);
        $recipe = $stmt3->fetch(PDO::FETCH_ASSOC);
        
        // Store the recipe details in the session for further usage
        $_SESSION["recipeno"] = $recipe;
    }

    // Optional: Handle cases where no recipe is found
    if (!$recipe) {
        echo "No recipe found with the given name.";
    }
} catch (PDOException $e) {
    // Error handling: Display a user-friendly error message
    echo "Error retrieving recipe: " . $e->getMessage();
}



// Vérification si un formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recipe_id'])) {
    $recipeId = $_POST['recipe_id'];
    $title = trim($_POST['title']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);

    if (!empty($title) && !empty($ingredients) && !empty($instructions)) {
        try {
            $query = "UPDATE recipes SET title = :title, ingredients = :ingredients, instructions = :instructions WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'title' => $title,
                'ingredients' => $ingredients,
                'instructions' => $instructions,
                'id' => $recipeId
            ]);
            $message = "Recette mise à jour avec succès !";
        } catch (PDOException $e) {
            $message = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    } else {
        $message = "Tous les champs sont requis.";
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Recette</title>
    <link rel="stylesheet" href="modify.css" >

</head>
<body>
    <header>
        
    </header>

    <main>
        <?php if ($_SESSION["recipeno"]): ?>
        <div class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Modifier "<?php echo htmlspecialchars($recipe['title']); ?>"</h2>
                    <button onclick="window.location.href='addrecipe.php';">Fermer</button>
                </div>
                <form method="post" action="modifier2.php">
                    <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
                    
                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>
                    
                    <label for="ingredients">Ingrédients :</label>
                    <textarea id="ingredients" name="ingredients" rows="4" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>
                    
                    <label for="instructions">Instructions :</label>
                    <textarea id="instructions" name="instructions" rows="4" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea>

                    <div class="modal-footer">
                        <button type="submit" onsubmit="window.location.href='addrecipe.php';">Enregistrer</button>
                    
                    </div>
                </form>
            </div>
        </div>
        <?php else: ?>
            <p>Recette non trouvée.</p>
        <?php endif; ?>
    </main>
</body>
</html>