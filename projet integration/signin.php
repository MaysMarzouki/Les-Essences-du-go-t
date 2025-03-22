<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="./img/cuisine.jpg" alt="Image">
    </div>
   
    <form class="form" method="POST" action="signin2.php">
        <p class="title">Se connecter</p>
        
        <label>
            <input class="input" type="email" name="email" placeholder="" required="">
            <span>Email</span>
        </label> 
        
        <label>
            <input class="input" type="password" name="password" placeholder="" required="">
            <span>Password</span>
        </label>
        
        <button class="submit">Submit</button>
        <p class="signin">Don't have an account? <a href="signup.php">Sign Up</a></p>
    </form>

    <h1>Les Essences du goût</h1>
</div>

</body>
</html>
