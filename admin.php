<!-- <html>
    <head>
        <title>
            admin 
         </title>
    </head>
<body>
<h1 align="center">admin</h1>
<h2>movie</h2>
<button><a href="data insert.php"> insert </a></button>
<button><a href="display.php"> display </a> </button>

</body>
</html> -->


<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
    <h1 align="center">Admin</h1>
    <h2>Movie</h2>
    <button><a href="data insert.php">Insert</a></button>
    <button><a href="display.php">Display</a></button>
    <br><br>
    <a href="logout.php">Logout</a>
</body>
</html>
