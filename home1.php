<?php require "function.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="we have a wide collection of electronics, phones, books">
    <meta name="keywords" content="phones, books, games, ele">
    <title>Watch Movies</title>

    <style>
        html.body {
            width: 100%;
            height: 100%;
            padding: 0px;
            margin: 0px;
            overflow-x: hidden;
        }

        body {
            background-color: black;
            color: white;
        }

        .bar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            font-family: sans-serif;
            letter-spacing: 1.5px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        video {
            width: 98vw;
            height: 100%;
            position: absolute;
            object-fit: cover;
            transition: all 1.2s linear;
            z-index: -10;
            top: 0px;
        }

        .video1 {
            opacity: 1;
        }

        .video2 {
            opacity: 0;
        }

        .video3 {
            opacity: 0;
        }

        .container {
            width: 100%;
            height: 100vh;
        }

        .films {
            position: relative;
            color: white;
        }

        img {
            width: 150px; /* Fixed width */
            height: 225px; /* Fixed height */
            object-fit: cover; /* Ensures the image covers the area without distortion */
            max-width: 100%; /* Ensures the image scales properly */
            border-radius: 10px; /* Optional: Adds rounded corners to the images */
        }

        #titles {
            color: white;
            position: relative;
            letter-spacing: 1.5px;
            text-decoration: none;
            margin: 0;
            padding-bottom: 5px;
        }

        #barimg {
            position: relative;
            width: 18vw;
            top: -2vw;
        }

        .films2 {
            color: yellow;
        }

        footer {
            position: relative;
            color: white;
        }

        h1 {
            color: white;
        }

        #family {
            position: relative;
            margin-top: 1px;
        }

        .aluthmovie {
            margin-top: 10vh;
        }

        .category {
            margin-bottom: 40px;
            text-decoration: none;
        }

        .movies {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 15px; /* Adds space between the items */
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

        .random-movie-section {
            margin-top: 8px;
            padding: 20px;
           
            border-radius: 10px;
        }

    </style>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="bar" align="right">
        <a href="*">HOME</a>&nbsp;&nbsp;&nbsp;
        <a href="*">MOVIES</a>&nbsp;&nbsp;&nbsp;
        <a href="*">TV SERIES</a>
    </div>
    <img id="barimg" src="20240118_200657.png">

    <div class="container">
        <video autoplay muted id="video1" class="video1">
            <source src="WWW.mp4" type="video/mp4">
        </video>

        <video muted id="video2" class="video2">
            <source src="www1.mp4" type="video/mp4">
        </video>

        <video muted id="video3" class="video3">
            <source src="www2.mp4" type="video/mp4">
        </video>
    </div>

    <!-- Random Movie Section -->
    <div class="random-movie-section">
        <h2>Random Movies</h2>
        <div class="movies">
            <?php
            $db = mysqli_connect("localhost:3307", "root", "", "movieworld");
            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch random movies (limit to 5)
            $sql = "SELECT m.movietype, m.name, m.image, m.about, m.imdb, m.video, m.year, f.hours, f.min 
                    FROM movies m 
                    LEFT JOIN fime_time f ON m.id = f.id 
                    ORDER BY RAND() LIMIT 5";
            $result = mysqli_query($db, $sql);

            while ($movie = mysqli_fetch_assoc($result)) {
                echo "<div class='random-movie-item'>";
                echo "<a href='sub.php?rn=" . urlencode($movie['name']) . "&ln=" . urlencode($movie['about']) . "&movietype=" . urlencode($movie['movietype']) . "&image=" . urlencode($movie['image']) . "&imdb=" . urlencode($movie['imdb']) . "&video=" . urlencode($movie['video']) . "&year=" . urlencode($movie['year']) . "&hours=" . urlencode($movie['hours']) . "&min=" . urlencode($movie['min']) . "'>";
                echo "<img src='images/" . $movie['image'] . "' alt='" . $movie['name'] . "'>";
                
                echo "<p>" . $movie['name'] . "<br><span style='font-size: 15px;    color: rgba(205, 211, 217, 0.468);
            }'>" . $movie['movietype'] . "</span></p>";

                echo "</div>";
                echo "</a>";
            }
            ?>
        </div>
    </div>

    <!-- Section to display movies by category -->
    <div class="aluthmovie">
        <?php
        $db = mysqli_connect("localhost:3307", "root", "", "movieworld");
        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch movies categorized by type
        $sql = "SELECT m.movietype, m.name, m.image, m.about, m.imdb, m.video, m.year, f.hours, f.min 
                FROM movies m 
                LEFT JOIN fime_time f ON m.id = f.id 
                ORDER BY m.movietype";
        $result = mysqli_query($db, $sql);
        $movies_by_type = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $movietype = $row['movietype'];
            if (!isset($movies_by_type[$movietype])) {
                $movies_by_type[$movietype] = [];
            }
            $movies_by_type[$movietype][] = $row;
        }
        ?>

        <div id="categories">
            <?php
            foreach ($movies_by_type as $movietype => $movies) {
                echo "<div class='category'>";
                echo "<h2><a href='sub_link_page.php?movietype=" . urlencode($movietype) . "'>" . $movietype . "</a></h2>";
                echo "<div class='movies'>";

                $count = 0;
                foreach ($movies as $movie) {
                    if ($count >= 5) break;

                    echo "<div class='movie-item'>";
                    echo "<a href='sub.php?rn=" . urlencode($movie['name']) . "&ln=" . urlencode($movie['about']) . "&movietype=" . urlencode($movie['movietype']) . "&image=" . urlencode($movie['image']) . "&imdb=" . urlencode($movie['imdb']) . "&video=" . urlencode($movie['video']) . "&year=" . urlencode($movie['year']) . "&hours=" . urlencode($movie['hours']) . "&min=" . urlencode($movie['min']) . "'>";
                    echo "<img src='images/" . $movie['image'] . "' alt='" . $movie['name'] . "'>";
                  
                    echo "<p>" . $movie['name'] . "<br><span style='font-size: 15px;    color: rgba(205, 211, 217, 0.468);
                }'>" . $movie['movietype'] . "</span></p>";
                    echo "</div>"; 
                     echo "</a>";

                    $count++;
                }
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <?php include "include/footer.php"; ?>
    <script src="java script.js"></script>

</body>

</html>
