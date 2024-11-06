
<!DOCTYPE html>
<html>
<head>
<title>Image Details</title>
</head>
<body>
<h1>Image Details</h1>
<?php
// Connect to database
$servername =
"localhost";
$username =
"root";
$password =
"";
$dbname =
"movieworld";
$conn = new mysqli($servername, $username,
$password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " .
$conn->connect_error);
}
// Fetch image details based on id from URL
parameter
if(isset($_GET['id'])) {
$id = $_GET['id'];
$sql =
"SELECT name FROM
movies WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
echo "<h2>" . $row["name"] . "</h2>";
// echo "<p>" . $row["description"] . "</p>";
} else {
echo "Image not found";
}
} else {
echo "Invalid request";
}
$conn->close();
?>
</body>
</html>