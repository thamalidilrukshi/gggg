<?php
include("connection.php");
error_reporting(0);
$rn = $_GET['rn'];
$ln = $_GET['ln'];
$image = $_GET['image'];
$movietype = $_GET['movietype'];
$year = $_GET['year'];
$hours = $_GET['hours'];
$min = $_GET['min'];
$imdb = $_GET['imdb'];
$video = $_GET['video'];

// Debugging line to check the value of $year
// Remove or comment this out in production
// var_dump($year);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($rn); ?></title>
    <style>
        body {
            background-color: black;
            padding: 0;
            margin: 0;
            padding-top: 60px; /* Space for the navbar */
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .image-container {
            position: absolute;
            right: 0;
            top: 0;
            width: 70vw;
            height: 100vh;
            overflow: hidden;
        }

        .blend-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .color-overlay {
            position: fixed;
            top: 70px; /* Adjust this to match the navbar height */
            left: 0;
            width: 100%;
            height: calc(100% - 40px); /* Adjust height to avoid navbar */
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            color: white;
            text-align: left;
            padding: 10px;
            z-index: 1;
        }

        .movietype {
            color: bisque;
            font-size: 20px;
        }

        .moviename {
            font-size: 70px;
        }

        #btn2, #btn1 {
            width: 150px;
            height: 50px;
            padding: 10px;
            font-size: 20px;
            cursor: pointer;
            border-radius: 10px;
        }

        #btn2 {
            background-color: bisque;
            color: black;
            border: none;
        }

        #btn1 {
            background: transparent;
            color: bisque;
            border: 3.3px solid bisque;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 5px 20px; /* Reduced padding */
            position: fixed;
            top: 0;
            width: 99%; /* Use full width */
            z-index: 3;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 5px 10px; /* Reduced padding */
            font-family: sans-serif;
            letter-spacing: 1.5px;
            font-weight: bold;
            font-size: 16px; /* Adjusted font size */
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: black;
        }

        /* Increased logo size */
        #barimg {
            width: 60px; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
        }

        /* New class for ln section */
        .line-text {
            position: fixed;
            top: 220px; /* Position from the top, adjust as needed */
            left: 10px; /* Position from the left */
            color: white; /* Text color */
            font-size: 16px; /* Font size */
            z-index: 2; /* Ensure it's above other content */
            max-width: 600px; /* Set a maximum width */
        }


        .movie-item, .random-movie-item {
            text-align: center;
            width: calc(20% - 20px); /* Ensures the items are equally spaced */
        }

        h2 {
            color: yellow;
            margin-bottom: 10px;
        }

        p {
            font-size: 19px;
            color: #ddd;
            margin-top: 5px;
        }

        a {
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease-in-out;
        }

        a:hover {
            transform: scale(1.05); /* Adds hover effect to scale the movie item */
        }

       /* css part  */

       .random-movie-section {
        position: absolute;
            padding: 10px;
            text-align: left;
            right: 20px;
            top: 300px;
            
        }

        .movies {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .random-movie-item {
            position: relative;
            width: 180px;
            margin: 15px;
            overflow: hidden;
            border-radius: 10px;
            background-color: #1c1c1c;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s;
        }

        .random-movie-item:hover {
            transform: scale(1.05);
        }

        .random-movie-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
        }

        .movie-item-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            opacity: 0;
            transition: opacity 0.10s;
            border-radius: 10px;
        }

        .random-movie-item:hover .movie-item-overlay {
            opacity: 1;
        }

        .movie-type {
            font-size: 14px;
            color: rgba(205, 211, 217, 0.7);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                display: block;
                margin: 5px 0;
            }

            .image-container {
                width: 100vw;
            }
        }
    </style>
</head>
<body>

<!-- Navigation bar -->
<div class="navbar">
    <img src="20240118_200657.png" alt="Logo" id="barimg">
    <div>
        <a href="home1.php">Home</a>
        <a href="aboutus.php">TV Series</a>
        <a href="aboutus.php">Movies</a>
        <a href="aboutus.php">About Us</a>
    </div>
</div>

<div class="color-overlay" id="colorOverlay">
    <div class="movietype"><?php echo htmlspecialchars($movietype); ?> |<?php echo htmlspecialchars($year); ?> </div> 
   <?php echo htmlspecialchars($min); ?> <!-- Displaying the year -->
    <div class="moviename"><?php echo htmlspecialchars($rn); ?></div>
    <div>IMDB: <?php echo htmlspecialchars($imdb); ?></div>
    <div style="display: flex; gap: 20px; margin-top: 250px;"> <!-- Increased margin-top -->
        <button id="btn2" onclick="location.href='movie video.php?rn=<?php echo urlencode($rn); ?>&movietype=<?php echo urlencode($movietype); ?>&video=<?php echo urlencode($video); ?>'">PLAY</button>
        <button id="btn1" onclick="location.href='movie_trailer.php?rn=<?php echo urlencode($rn); ?>&movietype=<?php echo urlencode($movietype); ?>&video=<?php echo urlencode($video); ?>'">Watch Trailer</button>
        <!-- delete karanna one tika -->

        <div class="random-movie-section">
   
    <div class="movies">
        <?php
        $db = mysqli_connect("localhost:3307", "root", "", "movieworld");
        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch random movies
        $sql = "SELECT m.movietype, m.name, m.image, m.about, m.imdb, m.video, m.year, f.hours, f.min 
                FROM movies m 
                LEFT JOIN fime_time f ON m.id = f.id 
                ORDER BY RAND() LIMIT 3";
        $result = mysqli_query($db, $sql);

        while ($movie = mysqli_fetch_assoc($result)) {
            echo "<div class='random-movie-item'>";
            echo "<a href='sub.php?rn=" . urlencode($movie['name']) . "&ln=" . urlencode($movie['about']) . "&movietype=" . urlencode($movie['movietype']) . "&image=" . urlencode($movie['image']) . "&imdb=" . urlencode($movie['imdb']) . "&video=" . urlencode($movie['video']) . "&year=" . urlencode($movie['year']) . "&hours=" . urlencode($movie['hours']) . "'>";
            echo "<img src='images/" . htmlspecialchars($movie['image']) . "' alt='" . htmlspecialchars($movie['name']) . "' class='random-movie-img'>";
            echo "<div class='movie-item-overlay'>";
            echo "<p>" . htmlspecialchars($movie['name']) . "<br><span class='movie-type'>" . htmlspecialchars($movie['movietype']) . "</span></p>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
        }
        ?>
    </div>
</div>

        <!-- ivarai -->
    </div>
</div>

<div class="image-container">
    <img src="images/<?php echo htmlspecialchars($image); ?>" alt="Movie Image" class="blend-image" id="movieImage">
</div>

<!-- Line text displayed at the left side -->
<div class="line-text"><?php echo htmlspecialchars($ln); ?></div>

<script>
    function getAverageColor(imgElement) {
        return new Promise((resolve) => {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = imgElement.width;
            canvas.height = imgElement.height;
            context.drawImage(imgElement, 0, 0, canvas.width, canvas.height);
            
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const data = imageData.data;
            let r = 0, g = 0, b = 0;

            for (let i = 0; i < data.length; i += 4) {
                r += data[i];
                g += data[i + 1];
                b += data[i + 2];
            }

            r = Math.floor(r / (data.length / 4));
            g = Math.floor(g / (data.length / 4));
            b = Math.floor(b / (data.length / 4));

            resolve(`${r},${g},${b}`);
        });
    }

    const movieImage = document.getElementById('movieImage');
    const colorOverlay = document.getElementById('colorOverlay');

    movieImage.onload = async function() {
        const averageColor = await getAverageColor(movieImage);
        colorOverlay.style.backgroundColor = `rgba(${averageColor}, 0.5)`;
    }
</script>





</body>
</html>
