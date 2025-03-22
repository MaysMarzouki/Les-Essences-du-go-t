<?php
// Start a session for managing user login state
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "notrebase"); // Change the database credentials if necessary

// Check the connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate: Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $check_email = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email is already registered!');</script>";
        $stmt->close();
    } else {
        // Insert the user into the database
        $stmt->close();
        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashed_password);

        if ($stmt->execute()) {
            // Automatically log the user in after successful registration
            $_SESSION['user_id'] = $conn->insert_id; // Get the newly created user's ID
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;

            // Redirect to the index page (index1.php)
            header("Location: index1.php");
            exit();
        } else {
            echo "<script>alert('Error: Could not register. Please try again.');</script>";
        }
        $stmt->close();
    }
}

$conn->close();
?>
