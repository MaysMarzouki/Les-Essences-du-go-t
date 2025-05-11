<?php
session_start();

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'notrebase';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
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