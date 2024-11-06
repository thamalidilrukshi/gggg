<?php
session_start();
$host = 'localhost:3307';
$dbname = 'movieworld';
$user = 'root';
$password = '';

// Connect to the database
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Check if the username already exists
    $check_user = $conn->prepare("SELECT id FROM login WHERE username = ?");
    $check_user->bind_param("s", $username);
    $check_user->execute();
    $check_user->store_result();

    if ($check_user->num_rows > 0) {
        $signup_error = "Username already exists. Choose a different one.";
    } else {
        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            header("Location: login.php"); // Redirect to login page after successful signup
            exit;
        } else {
            $signup_error = "Error: Unable to register. Please try again.";
        }
        $stmt->close();
    }
    $check_user->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
</head>
<body>
    <h2>Signup</h2>
    <?php if (isset($signup_error)) echo "<p style='color: red;'>$signup_error</p>"; ?>
    <form action="signup.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Signup">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
