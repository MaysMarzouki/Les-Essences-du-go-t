<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Recipes</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <div class="search-container">
        <h1>Find Your Favorite Recipes</h1>
        <p>Search for the perfect recipe and explore culinary inspiration!</p>
        
        <form class="search-form" action="search_results.php" method="GET">
            <input type="text" name="query" class="search-input" placeholder="Enter recipe name or ingredient..." required>
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>
</body>
</html>
