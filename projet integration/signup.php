<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="./img/cuisine.jpg" alt="Image">
    </div>

    <form class="form" method="POST" action="signup2.php">
        <p class="title">S'identifier</p>

        <div class="flex">
            <label>
                <input class="input" type="text" name="firstname" placeholder="" required="">
                <span>Firstname</span>
            </label>

            <label>
                <input class="input" type="text" name="lastname" placeholder="" required="">
                <span>Lastname</span>
            </label>
        </div>  

        <label>
            <input class="input" type="email" name="email" placeholder="" required="">
            <span>Email</span>
        </label> 
        
        <label>
            <input class="input" type="password" name="password" placeholder="" required="">
            <span>Password</span>
        </label>

        <label>
            <input class="input" type="password" name="confirm_password" placeholder="" required="">
            <span>Confirm Password</span>
        </label>

        <button class="submit">Submit</button>
        <p class="signin">Already have an account? <a href="signin.php">Sign In</a></p>
    </form>

    <h1>Les Essences du goût</h1>
</div>

</body>
</html>
