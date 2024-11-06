<?php
// Connect to the database
$db = mysqli_connect("localhost:3307", "root", "", "movieworld");

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'movietype' is passed in the URL
if (isset($_GET['movietype'])) {
    $movietype = mysqli_real_escape_string($db, $_GET['movietype']); // Get the movietype from the query string
} else {
    die("Movie type not specified.");
}

// Query to fetch movies of the selected movietype
$sql = "SELECT m.movietype, m.name, m.image, m.about, m.imdb, m.video, m.year, f.hours, f.min 
FROM movies m 
LEFT JOIN fime_time f ON m.id = f.id 
WHERE m.movietype = '$movietype' 
ORDER BY m.movietype";

$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movietype); ?> Movies</title>
    <style>
        body {
            background-color: black;
            color: white;
            padding: 20px;
        }
        .films-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 items per row */
            gap: 20px;
            padding: 20px;
        }
        .films {
            color: white;
            text-align: center;
            border: 1px solid white;
            padding: 10px;
            border-radius: 10px;
        }
        img {
            width: 100px;
            height: 150px;
            border-radius: 10%;
        }
        .films2 {
            color: yellow;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h1><?php echo htmlspecialchars($movietype); ?> Movies</h1>

<div class="films-container">
    <?php
    // Check if there are movies of the selected category
    if (mysqli_num_rows($result) > 0) {
        // Loop through the movies and display them
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
                <div class='films'>
                    <a href='sub.php?rn=" . urlencode($row['name']) . "&ln=" . urlencode($row['about']) . "&movietype=" . urlencode($row['movietype']) . "&image=" . urlencode($row['image']) . "&imdb=" . urlencode($row['imdb']) . "&video=" . urlencode($row['video']) . "&year=" . urlencode($row['year']) . "&hours=" . urlencode($row['hours']) . "'>
                        <img src='images/" . $row['image'] . "' alt='" . htmlspecialchars($row['name']) . "'>
                        <p>" . htmlspecialchars($row['name']) . "</p>
                        <div class='films2'>" . htmlspecialchars($row['movietype']) . "</div>
                    </a>
                </div>
            ";
        }
    } else {
        echo "<p>No movies found in this category.</p>";
    }
    ?>
</div>

</body>
</html>
