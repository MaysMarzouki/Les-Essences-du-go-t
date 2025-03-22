<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recettes de Cuisine Thaïlandaise</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
  <!-- Top Banner Section -->
  <header class="top-banner">
    <div class="banner-center">
      <h1>Les Essences du goût</h1>
    </div>
    <div class="banner-right button-container">
      <button class="button" title="Favoris"><i class="fas fa-heart"></i></button>
      <button class="button" title="Recherche"><i class="fas fa-search"></i></button>
      <a href="signin.php">
    <button class="button" title="Mon Compte"><i class="fas fa-user"></i></button>
</a>
    </div>
  </header>

  <!-- Hero Section -->
  <main>
    <section class="hero">
      <h2>Explorez la richesse des saveurs thaïlandaises</h2>
      <p>Plongez dans une expérience culinaire authentique et savoureuse.</p>
      <img src="thai.jpg" alt="Un délicieux plat thaïlandais" class="hero-image">
      <div class="presentation">
        <h3>À propos de nous</h3>
        <p>
          Les Essences du Goût est une entreprise dédiée à la valorisation des traditions culinaires du monde. 
          À travers des services de restauration, d’ateliers et de conseil culinaire, 
          nous allions authenticité́, innovation et excellence pour offrir des expériences gustatives uniques. 
          <strong>Notre mission :</strong> sublimer chaque saveur et éveiller les papilles des amateurs de cuisine.
        </p>
      </div>
    </section>

    <!-- Sticky Recipe Navigation Bar -->
    <nav class="recipe-nav">
      <ul>
        <li><a href="#entrees">Entrées</a></li>
        <li><a href="#plats-principaux">Plats principaux</a></li>
        <li><a href="#soups">Soupes</a></li>
        <li><a href="#desserts">Desserts</a></li>
        <li><a href="#vegan">Végétariens</a></li>
        <li><a href="#specialites">Spécialités Thaïlandaises</a></li>
      </ul>
    </nav>

    <!-- Recipe Section Example -->
    <section class="recipe-section" id="entrees">
        <h3>Entrées</h3>
        <div class="recipe-grid">
          <div class="recipe-card">
            <img src="thai.jpg" alt="Salade thaïlandaise" class="recipe-image">
            <div class="recipe-overlay">
              <p>Entrées</p>
            </div>
            <p class="recipe-description">
              Une salade thaïlandaise rafraîchissante composée de papaye verte, carottes, et une touche de citron vert.
            </p>
            <button class="fav-btn" title="Ajouter aux Favoris">
                <i class="fas fa-heart"></i>
              </button>
          </div>
          <div class="recipe-card">
            <img src="thai.jpg" alt="Nem croustillant" class="recipe-image">
            <div class="recipe-overlay">
              <p>Entrées</p>
            </div>
            <p class="recipe-description">
              Des nems croustillants farcis au porc ou aux légumes, accompagnés d'une sauce aigre-douce.
            </p>
            <button class="fav-btn" title="Ajouter aux Favoris">
                <i class="fas fa-heart"></i>
              </button>
          </div>
          <div class="recipe-card">
            <img src="thai.jpg" alt="Soupe Tom Yum" class="recipe-image">
            <div class="recipe-overlay">
              <p>Entrées</p>
            </div>
            <p class="recipe-description">
              Une soupe piquante et parfumée avec des crevettes, citronnelle, et feuilles de citron vert.
            </p>
            <button class="fav-btn" title="Ajouter aux Favoris">
                <i class="fas fa-heart"></i>
              </button>
          </div>
        </div>
      </section>
      
      <section class="recipe-section" id="plats-principaux">
        <h3>Plats Principaux</h3>
        <div class="recipe-grid">
          <div class="recipe-card">
            <img src="thai.jpg" alt="Pad Thaï" class="recipe-image">
            <div class="recipe-overlay">
              <p>Plats Principaux</p>
            </div>
            <p class="recipe-description">
              Le célèbre Pad Thaï : nouilles sautées avec crevettes, tofu, et cacahuètes, le tout relevé d'une sauce tamarin.
            </p>
            <button class="fav-btn" title="Ajouter aux Favoris">
                <i class="fas fa-heart"></i>
              </button>
          </div>
          <div class="recipe-card">
            <img src="thai.jpg" alt="Curry vert" class="recipe-image">
            <div class="recipe-overlay">
              <p>Plats Principaux</p>
            </div>
            <p class="recipe-description">
              Un curry vert riche et crémeux, préparé avec du poulet, lait de coco et des légumes frais.
            </p>
            <button class="fav-btn" title="Ajouter aux Favoris">
                <i class="fas fa-heart"></i>
              </button>
          </div>
          <div class="recipe-card">
            <img src="thai.jpg" alt="Porc au basilic" class="recipe-image">
            <div class="recipe-overlay">
              <p>Plats Principaux</p>
            </div>
            <p class="recipe-description">
              Du porc sauté au basilic thaï, piment et ail, servi avec du riz jasmin.
            </p>
            <button class="fav-btn" title="Ajouter aux Favoris">
                <i class="fas fa-heart"></i>
              </button>
          </div>
        </div>
        
      </section>
      
  </main>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2025 Cuisine Thaïlandaise. Tous droits réservés.</p>
    <p class="entreprise-footer">Entreprise d’accueil : <strong>Les Essences du goût</strong></p>
  </footer>
</body>
</html>
