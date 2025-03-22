<?php
// Start the session to manage user login state
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Database connection credentials
        $servername = 'localhost';
        $username = 'root';
        $passwordDb = ''; // Database password
        $nom_base = 'notrebase'; // Replace with your actual database name

        try {
            // Establish a connection to the database using PDO
            $conn = new PDO("mysql:host=$servername;dbname=$nom_base", $username, $passwordDb);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query to check if the user exists
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Store user information in the session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['firstname'] = $user['firstname'];
                    $_SESSION['lastname'] = $user['lastname'];

                    // Redirect to the main page (index1.php)
                    header("Location: index1.php");
                    exit();
                } else {
                    echo "<script>alert('Incorrect password!');</script>";
                }
            } else {
                echo "<script>alert('No account found with this email.');</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Email and password are required!');</script>";
    }
}
?>
