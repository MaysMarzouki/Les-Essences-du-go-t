<?php


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

// Gestion des actions (ajout ou suppression)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $userId = $_SESSION['user_id']; // Remplacez 1 par l'ID réel de l'utilisateur connecté
    

    // Add ALTER TABLE statement to ensure AUTO_INCREMENT
    $alterQuery = "ALTER TABLE recipes MODIFY COLUMN id INT AUTO_INCREMENT;";
    $pdo->exec($alterQuery); 

    if ($action === 'add') {
        $title = trim($_POST['title'] ?? '');
        $ingredients = trim($_POST['ingredients'] ?? '');
        $instructions = trim($_POST['instructions'] ?? '');
    
        if (!empty($title) && !empty($ingredients) && !empty($instructions)) {
            try {
                $query = "INSERT INTO recipes (title, user_id, ingredients, instructions) VALUES (:title, :user_id, :ingredients, :instructions)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    'title' => $title,
                    'user_id' => $userId,
                    'ingredients' => $ingredients,
                    'instructions' => $instructions
                ]);
                $message = "Recette ajoutée avec succès !";
            } catch (Exception $e) {
                $message = "Erreur lors de l'ajout : " . $e->getMessage();
            }
        } else {
            $message = "Tous les champs sont requis.";
        }
    
    } elseif ($action === 'delete') {
    
        
            try {
                

                // Ensure the query to get the recipe ID is syntactically correct
                $query1 = "SELECT id FROM recipes WHERE title = :recipename";
                $stmt1 = $pdo->prepare($query1);
                $stmt1->execute(['recipename' => $_POST['recette']]); // Proper parameter binding
                
                $result = $stmt1->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
                
    
                if ($result) {
                    $query = "DELETE FROM recipes WHERE id = :recipe_id"; // Correct DELETE query
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(['recipe_id' => $result['id']]); // Pass the fetched ID to the DELETE query
                    $message = "Recette supprimée avec succès !";
                } else {
                    $message = "Recette introuvable.";
                }
            } catch (Exception $e) {
                $message = "Erreur lors de la suppression : " . $e->getMessage();
            }
        
    }

}


// Récupération de la liste des recettes
$query = "SELECT id, title FROM recipes";
$recipes = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Recettes</title>
    <link rel="stylesheet" href="addrecipe.css">
</head>
<body>
    <header>
        <h1>Gestion des Recettes</h1>
    </header>
    <main>
        <!-- Message d'état -->
        <?php if (isset($message)): ?>
            <p style="color: green; text-align: center;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        
        <!-- Formulaire d'ajout -->
        <section>
            <form id="recipeForm" method="post"  action="addrecipe.php">
                <h2>Ajouter une Recette</h2>
                <label for="recipeName">Nom de la recette :</label>
                <input type="text" id="recipeName" name="title" required>

                <label for="ingredients">Ingrédients :</label>
                <textarea id="ingredients" name="ingredients" rows="4" required></textarea>

                <label for="instructions">Instructions :</label>
                <textarea id="instructions" name="instructions" rows="4" required></textarea>

                <button type="submit" name="action" value="add">Enregistrer</button>
            </form>
        </section>


        <!-- Liste des recettes -->
        <section id="recipeList">
            <h2>Liste des Recettes</h2>
            <ul>
                <?php foreach ($recipes as $recipe): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($recipe['title']); ?></h3>
                        <form method="POST" action="modifier2.php">
                        <button  name="recette1" value="<?php echo htmlspecialchars($recipe['title']); ?>" >Modifier</button>
                        </form>
                        <?php
                                if (!isset($_SESSION)) {
                                    session_start();
                                }


                                if (isset($_POST['recette1'])) {
                                    $_SESSION["nomrecette"] = $_POST['recette1'];
                                }
                            ?>
                        <form method="post" style="display:inline;" action="addrecipe.php">
                            <input type="hidden" name="recette" value="<?php echo htmlspecialchars($recipe['title']); ?>">
                            <button type="submit" name="action" value="delete">Supprimer</button>
                            </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

    </main>
</body>
</html>