<?php
include("connection.php");
error_reporting(0);
$rn = $_GET['rn'];

// Fetch the movie details from the database based on the movie name (or another identifier)
$query = "SELECT * FROM movies WHERE name='$rn'";
$result = mysqli_query($conn, $query);
$movie = mysqli_fetch_assoc($result);

// Store values for easier access
$ln = $movie['about'];
$movietype = $movie['movietype'];
$image = $movie['image'];
$imdb = $movie['imdb'];
$video = $movie['video'];
$hours = $movie['hours'];
$min = $movie['min'];
?>

<html>
<head>
    <title>Update Movie Details</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Improved font for readability */
            background-color: #f4f4f4; /* Light background color for contrast */
            margin: 0;
            padding: 20px; /* Add padding around the body */
        }

        form {
            background-color: #fff; /* White background for form */
            padding: 20px; /* Padding inside the form */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            max-width: 500px; /* Max width for better layout */
            margin: auto; /* Center the form */
        }

        label {
            margin-top: 10px; /* Space above labels */
            display: block; /* Block display for labels */
            font-weight: bold; /* Bold labels for clarity */
        }

        input[type="text"], select, textarea {
            width: 100%; /* Full width for inputs */
            padding: 10px; /* Padding inside inputs */
            margin: 5px 0 15px 0; /* Margin for spacing */
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px; /* Rounded corners for inputs */
            font-size: 16px; /* Font size for inputs */
        }

        textarea {
            height: 100px; /* Fixed height for textarea */
            resize: vertical; /* Allow vertical resizing */
        }

        input[type="submit"] {
            background-color: #4CAF50; /* Button color */
            color: white; /* Button text color */
            border: none; /* Remove border */
            padding: 15px; /* Padding for button */
            font-size: 18px; /* Font size for button */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease; /* Smooth transition */
            width: 100%; /* Full width for button */
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
<form action="" method="GET">
   <label for="name">Name</label>
   <input type="text" value="<?php echo htmlspecialchars($rn); ?>" name="name" required>

   <label for="about">About</label>
   <textarea name="about" required><?php echo htmlspecialchars($ln); ?></textarea>

   <label for="movietype">Movie Type</label>
   <select name="movietype" required>
        <option value="" selected hidden>Select type</option>
        <option value="thrillers" <?php echo ($movietype == 'thrillers') ? 'selected' : ''; ?>>Thrillers</option>
        <option value="comedy" <?php echo ($movietype == 'comedy') ? 'selected' : ''; ?>>Comedy</option>
        <option value="action" <?php echo ($movietype == 'action') ? 'selected' : ''; ?>>Action</option>
        <option value="Family movie" <?php echo ($movietype == 'Family movie') ? 'selected' : ''; ?>>Family movie</option>
        <option value="horror" <?php echo ($movietype == 'horror') ? 'selected' : ''; ?>>Horror</option>
        <option value="children" <?php echo ($movietype == 'children') ? 'selected' : ''; ?>>Children</option>
    </select>

   <label for="hours">Time (Hours)</label>
   <input type="text" value="<?php echo htmlspecialchars($hours); ?>" name="hours" required>

   <label for="min">Time (Minutes)</label>
   <input type="text" value="<?php echo htmlspecialchars($min); ?>" name="min" required>

   <input type="submit" id="button" name="submit" value="Update Details">
</form>

<?php
if (isset($_GET['submit'])) {
    $name = $_GET['name'];
    $about = $_GET['about'];
    $movietype = $_GET['movietype'];
    $hours = $_GET['hours'];
    $min = $_GET['min'];

    $query = "UPDATE movies SET name='$name', about='$about', movietype='$movietype' WHERE name='$rn'";
    $data = mysqli_query($conn, $query);

    $query1 = "UPDATE fime_time SET hours='$hours', min='$min' WHERE name='$rn'"; // Make sure to add a condition here
    $data1 = mysqli_query($conn, $query1);

    if ($data && $data1) {
        echo "<script>alert('Record updated')</script>";
        echo '<meta http-equiv="refresh" content="0; URL=http://localhost/web/insert%20data/display.php">';
    } else {
        echo "<font color='red'>Failed to update record</font>";
    }
}
?>
</body>
</html>
